<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Escape;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $posts = BlogPost::latest()->get();
        $escapes = Escape::latest()->get();
        return view('admin.dashboard', compact('posts', 'escapes'));
    }

    public function posts()
    {
        $posts = BlogPost::latest()->get();
        return view('admin.posts', compact('posts'));
    }

    public function createPost()
    {
        return view('admin.post-form', ['post' => null]);
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

        $post = BlogPost::create($data);

        return redirect()->route('admin.posts')
            ->with('success', 'Post created!');
    }

    public function editPost(BlogPost $blogPost)
    {
        return view('admin.post-form', ['post' => $blogPost]);
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

        return redirect()->route('admin.posts')
            ->with('success', 'Post updated!');
    }

    public function destroyPost(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('admin.posts')
            ->with('success', 'Post deleted.');
    }

    // ── Escapes ──

    public function escapes()
    {
        $escapes = Escape::latest()->get();
        return view('admin.escapes-manage', compact('escapes'));
    }

    public function editEscape(Escape $escape)
    {
        return view('admin.escape-form', compact('escape'));
    }

    public function updateEscape(Request $request, Escape $escape)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ]);

        $escape->update($data);

        return redirect()->route('admin.escapes.manage')
            ->with('success', 'Escape updated.');
    }

    public function destroyEscape(Escape $escape)
    {
        Storage::disk('public')->delete($escape->file_path);
        $escape->delete();
        return redirect()->route('admin.escapes.manage')
            ->with('success', 'Escape deleted.');
    }
}
