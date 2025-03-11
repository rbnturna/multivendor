<?php

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::all();
        return view('vendor.blogcategory.index', compact('categories'));
    }

    public function create()
    {
        return view('vendor.blogcategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blogCategory = BlogCategory::create($request->all());
        
        $imagePath = $request->file('image')->store('blogs/images', 'public');
        $blogCategory->update(['image' => $imagePath]);

        
        return redirect()->route('vendor.blogcategories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $blogCategory = BlogCategory::find($id);
        // dd($blogCategory);
        return view('vendor.blogcategory.edit', compact('blogCategory'));
    }
    public function show($id)
    {
        $blogCategory = BlogCategory::find($id);
        // dd($blogCategory);
        return view('vendor.blogcategory.show', compact('blogCategory'));
    }

    public function update(Request $request, $id)
    {
        $blogCategory = BlogCategory::find($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_categories,slug,' . $blogCategory->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request->all());

        // Handle main image upload
        $imagePath = $request->file('image')->store('blogs/images', 'public');

        // dd($imagePath);
        $blogCategory->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
        // dd($blogCategory);

        // $blogCategory->update(['image' => $imagePath]);
        return redirect()->route('vendor.blogcategories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $blogCategory = BlogCategory::find($id);
        $blogCategory->delete();
        return redirect()->route('vendor.blogcategories.index')->with('success', 'Category deleted successfully.');
    }
}