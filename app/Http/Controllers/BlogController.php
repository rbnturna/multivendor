<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs.
     */
    public function index(Request $request)
    {
        $query = Blog::query();

        // if ($request->has('search') && !empty($request->search)) {
        //     $query->where('blogs.title', 'like', '%' . $request->search . '%');
        // }
        if ($request->has('search') && !empty($request->search)) {
            $searchTerms = explode(' ', $request->search);
            $query->where(function($q) use ($searchTerms) {
            foreach ($searchTerms as $term) {
                $q->orWhere('blogs.title', 'like', '%' . $term . '%')
                  ->orWhere('blogs.short_description', 'like', '%' . $term . '%');
            }
            });
        }
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('blog_categories.id', $request->category);
            });
        }

        if ($request->has('tag') && !empty($request->tag)) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('blog_tags.id', $request->tag);
            });
        }

        $blogs = $query->get();

        // dd($blogs );
        $categories = BlogCategory::all();
        $tags = BlogTag::all();

        if ($request->ajax()) {

            if ($blogs->isEmpty()) {
                return response()->json(['message' => 'No blogs found'], 404);
            }
            return view('frontend.blogs.partials.blogs', ['blogs' => $blogs])->render();
        }

        return view('frontend.blogs.index', compact('blogs', 'categories', 'tags'));
    }

    /**
     * Display the specified blog.
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->with('categories','tags')->firstOrFail();
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('frontend.blogs.show', compact('blog','categories','tags'));
    }
}
