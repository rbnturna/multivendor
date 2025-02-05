<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('superadmin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('superadmin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('pages') : null;

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('superadmin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('superadmin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->file('image')) {
            if ($page->image) {
                Storage::delete($page->image);
            }
            $page->image = $request->file('image')->store('pages');
        }

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
        ]);

        return redirect()->route('superadmin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        if ($page->image) {
            Storage::delete($page->image);
        }
        $page->delete();
        return redirect()->route('superadmin.pages.index')->with('success', 'Page deleted successfully.');
    }

    public function show(Page $page)
    {
        $processedContent = $page->processContent();
        return view('superadmin.pages.show', compact('page', 'processedContent'));
    }

    public function handleContactForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send the email
        Mail::raw($validated['message'], function ($mail) use ($validated) {
            $mail->to('admin@example.com')
                 ->from($validated['email'], $validated['name'])
                 ->subject('Contact Form Message');
        });

        return redirect()->back()->with('success', 'Your message has been sent!');
    }

    public function handleNewsletterForm(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        // Simulate saving the email to a database or service
        return redirect()->back()->with('success', 'You have successfully subscribed to the newsletter!');
    }
}
