<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()->latest('published_at')->paginate(10);
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->published()->firstOrFail();
        return view('blog.show', compact('post'));
    }

    public function about()
    {
        return view('blog.about');
    }

    // --- Admin ---

    public function adminIndex()
    {
        $posts = BlogPost::latest()->paginate(20);
        return view('admin.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable',
            'content' => 'required',
            'category' => 'nullable|max:100',
            'featured_image' => 'nullable|url',
            'is_published' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['published_at'] = $data['is_published'] ?? false ? now() : null;
        $data['is_published'] = $data['is_published'] ?? false;

        BlogPost::create($data);

        return redirect()->route('admin.index')->with('success', 'Blog post created!');
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable',
            'content' => 'required',
            'category' => 'nullable|max:100',
            'featured_image' => 'nullable|url',
            'is_published' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        if (($data['is_published'] ?? false) && !$blogPost->published_at) {
            $data['published_at'] = now();
        }
        $data['is_published'] = $data['is_published'] ?? false;

        $blogPost->update($data);

        return redirect()->route('admin.index')->with('success', 'Blog post updated!');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('admin.index')->with('success', 'Blog post deleted!');
    }
}
