<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('vendor.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('vendor.category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => $request->slug ?? Str::slug($request->name),
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('vendor.category.index')->with('success', 'Category added successfully!');
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('vendor.category.edit', compact('category', 'categories'));
    }

    // public function update(Request $request, Category $category)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'slug' => 'nullable|string|unique:categories,slug,' . $category->id . '|max:255',
    //         'description' => 'nullable|string',
    //         'image' => 'nullable|image|max:2048',
    //     ]);

    //     $imagePath = $category->image;
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('categories', 'public');
    //     }

    //     $category->update([
    //         'parent_id' => $request->parent_id,
    //         'name' => $request->name,
    //         'slug' => $request->slug ?? Str::slug($request->name),
    //         'description' => $request->description,
    //         'image' => $imagePath,
    //     ]);

    //     return redirect()->route('vendor.category.index')->with('success', 'Category updated successfully!');
    // }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $category->update([
            'parent_id' => $category->id, // Ensure parent_id is the logged-in user
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $request->file('image') ? $request->file('image')->store('categories', 'public') : $category->image,
        ]);

        return redirect()->route('vendor.category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('vendor.category.index')->with('success', 'Category deleted successfully!');
    }
}
