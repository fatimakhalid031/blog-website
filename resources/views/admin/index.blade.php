@extends('layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="admin-layout">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
            <h1 style="font-size: 1.6rem;">dashboard</h1>
            <a href="{{ route('admin.create') }}" class="btn">New Entry</a>
        </div>
        <p style="font-size: 0.8rem; color: #b8a890; margin-bottom: 28px; font-style: italic;">
            the quiet work of showing up
        </p>

        @if($posts->count() > 0)
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <a href="{{ route('blog.show', $post->slug) }}" style="font-weight: 400; color: #1a1a1a;">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td>
                                @if($post->is_published)
                                    <span style="font-size: 0.65rem; color: #8a9a7a;">Published</span>
                                @else
                                    <span style="font-size: 0.65rem; color: #bbb;">Draft</span>
                                @endif
                            </td>
                            <td style="font-size: 0.75rem; color: #888;">
                                {{ $post->formatted_date }}
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.edit', $post) }}" class="btn btn-sm">Edit</a>
                                <form action="{{ route('admin.destroy', $post) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this entry?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $posts->links() }}
            </div>
        @else
            <div style="padding: 60px 0; text-align: center; color: #aaa;">
                <p style="font-family: 'Playfair Display', serif; font-size: 1.1rem; font-style: italic;">Nothing here yet.</p>
                <p style="font-size: 0.8rem; margin-top: 8px;">
                    <a href="{{ route('admin.create') }}" style="text-decoration: underline;">Write your first entry →</a>
                </p>
            </div>
        @endif
    </div>
@endsection
