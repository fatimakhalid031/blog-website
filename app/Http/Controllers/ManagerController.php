<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Escape;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManagerController extends Controller
{
    // ─── Dashboard ───

    public function dashboard()
    {
        $posts = BlogPost::latest()->get();
        $escapes = Escape::latest()->get();
        return view('manager.dashboard', compact('posts', 'escapes'));
    }

    // ─── Blog Posts (Add + Edit — NO Delete) ───

    public function posts()
    {
        $posts = BlogPost::latest()->get();
        return view('manager.posts', compact('posts'));
    }

    public function createPost()
    {
        return view('manager.post-form', ['post' => null]);
    }

    public function storePost(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:blog_posts,slug',
            'body' => 'required',
            'excerpt' => 'nullable|max:500',
            'category' => 'nullable|max:100',
        ]);

        BlogPost::create($data);

        return redirect()->route('manager.posts')
            ->with('success', 'Post created successfully!');
    }

    public function editPost(BlogPost $blogPost)
    {
        return view('manager.post-form', ['post' => $blogPost]);
    }

    public function updatePost(Request $request, BlogPost $blogPost)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:blog_posts,slug,' . $blogPost->id,
            'body' => 'required',
            'excerpt' => 'nullable|max:500',
            'category' => 'nullable|max:100',
        ]);

        $blogPost->update($data);

        return redirect()->route('manager.posts')
            ->with('success', 'Post updated successfully!');
    }

    // ─── Escapes (Add + Edit — NO Delete) ───

    public function escapes()
    {
        $escapes = Escape::latest()->get();
        return view('manager.escapes', compact('escapes'));
    }

    public function editEscape(Escape $escape)
    {
        return view('manager.escape-form', compact('escape'));
    }

    public function updateEscape(Request $request, Escape $escape)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ]);

        $escape->update($data);

        return redirect()->route('manager.escapes')
            ->with('success', 'Escape updated successfully!');
    }
}
