<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
     /**
     * Display a listing of products.
     */
    public function index()
    {
        $blogs = Blog::with('categories')->get();
        $categories = BlogCategory::all();
        return view('superadmin.blogs.index', compact('blogs','categories'));
        // return response()->json($blogs);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('superadmin.blogs.create',compact('tags','categories'));
        // Return a view for creating products (if using Blade).
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Handle main image upload
        $imagePath = $request->file('image')->store('blogs/images', 'public');

        
        // Save product details
        $blog = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $imagePath,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'is_active' => $request->has('is_active'),
        ]);

        $blog->categories()->sync($request->categories);
        $blog->tags()->sync($request->tags);
        return redirect()->route('superadmin.blogs.index')->with('success', 'Product created successfully!');
        // return response()->json(['message' => 'Product created successfully', 'product' => $blog]);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json($blog);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        // dd($id);
        $blog = Blog::find($id);
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('superadmin.blogs.edit',compact('blog','categories','tags'));
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Handle main image upload
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($blog->image); // Delete old image
            $blog->image = $request->file('image')->store('blogs/images', 'public');
        }


        // Update product details
        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'short_description' => $request->short_description,
            'is_active' => $request->has('is_active')
        ]);
        $blog->categories()->sync($request->categories);
        $blog->tags()->sync($request->tags);
        return redirect()->route('superadmin.blogs.edit',$id )->with('success', 'Product updated successfully!');
        //return response()->json(['message' => 'Product updated successfully', 'product' => $blog]);
    }

    /**
     * Remove the specified product from the database.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->categories()->detach(); 
        // Delete images
        Storage::disk('public')->delete($blog->image);
       
        $blog->delete();
        return redirect()->route('superadmin.blogs.index')->with('success', 'Product deleted successfully!');
        //return response()->json(['message' => 'Product deleted successfully']);
    }

}
