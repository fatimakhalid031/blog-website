@extends('manager.layout')

@section('title', 'Edit Escape')
@section('page-title', 'Edit Escape')

@section('mgr-content')
    <div class="mgr-card" style="max-width:600px;">
        <form action="{{ route('manager.escape-update', $escape) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control"
                       value="{{ old('title', $escape->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"
                          rows="3">{{ old('description', $escape->description) }}</textarea>
            </div>

            <div style="margin-bottom:20px;padding:12px 16px;background:var(--mgr-bg);border-radius:8px;font-size:0.85rem;">
                <div style="color:var(--mgr-text-muted);margin-bottom:4px;">Video</div>
                <div style="font-weight:500;">{{ $escape->original_name ?? $escape->file_path }}</div>
                <div style="color:var(--mgr-text-muted);font-size:0.75rem;">{{ $escape->formatted_file_size }} · {{ $escape->mime_type ?? 'video/webm' }}</div>
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Update Escape</button>
                <a href="{{ route('manager.escapes') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
@endsection
