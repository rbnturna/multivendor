<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    public function index()
    {
        $tags = BlogTag::all();
        return view('vendor.blogtag.index', compact('tags'));
    }

    public function create()
    {
        return view('vendor.blogtag.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_tags',
        ]);

        BlogTag::create($request->all());

        return redirect()->route('vendor.blogtag.index')->with('success', 'Tag created successfully.');
    }

    public function show($id)
    {
        $blogTag = BlogTag::find($id);
        return view('vendor.blogtag.show', compact('blogTag'));
    }

    public function edit($id)
    {
        $blogTag = BlogTag::find($id);
        return view('vendor.blogtag.edit', compact('blogTag'));
    }

    public function update(Request $request, $id)
    {
        $blogTag = BlogTag::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_tags,slug,' . $blogTag->id,
        ]);

        $blogTag->update($request->all());

        return redirect()->route('vendor.blogtag.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy($id)
    {
        $blogTag = BlogTag::find($id);
        $blogTag->delete();

        return redirect()->route('vendor.blogtag.index')->with('success', 'Tag deleted successfully.');
    }
}