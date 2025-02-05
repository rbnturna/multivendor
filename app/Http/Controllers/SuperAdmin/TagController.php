<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('superadmin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('superadmin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:tags,slug|max:255',
        ]);

        Tag::create($request->all());

        return redirect()->route('superadmin.tags.index')->with('success', 'Tag created successfully!');
    }

    public function edit(Tag $tag)
    {
        return view('superadmin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:tags,slug,' . $tag->id . '|max:255',
        ]);

        $tag->update($request->all());

        return redirect()->route('superadmin.tags.index')->with('success', 'Tag updated successfully!');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('superadmin.tags.index')->with('success', 'Tag deleted successfully!');
    }
}
