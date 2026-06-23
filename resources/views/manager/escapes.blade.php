@extends('manager.layout')

@section('title', 'Escapes')
@section('page-title', 'Escapes')

@section('mgr-content')
    <div class="mgr-card">
        <div class="mgr-card-header">
            <h2 class="mgr-card-title">All Escapes</h2>
            <a href="{{ route('admin.escapes.create') }}" class="btn btn-primary btn-sm">+ Upload</a>
        </div>
        @if($escapes->count() > 0)
        <div class="mgr-table-wrap">
            <table class="mgr-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Size</th>
                        <th>Uploaded</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($escapes as $escape)
                    <tr>
                        <td style="font-weight:500;">{{ $escape->title }}</td>
                        <td>
                            @if($escape->is_processing)
                                <span class="mgr-badge processing">Processing</span>
                            @else
                                <span class="mgr-badge done">Ready</span>
                            @endif
                        </td>
                        <td style="color:var(--mgr-text-muted);font-size:0.8rem;">{{ $escape->formatted_file_size }}</td>
                        <td style="color:var(--mgr-text-muted);font-size:0.8rem;">{{ $escape->created_at->format('M j, Y') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('manager.escape-edit', $escape) }}" class="btn btn-sm">Edit</a>
                                {{-- No delete button --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="color:var(--mgr-text-muted);font-size:0.9rem;padding:20px 0;">
            No escapes yet.
            <a href="{{ route('admin.escapes.create') }}" style="color:var(--mgr-accent);">Upload your first escape</a>.
        </p>
        @endif
    </div>
@endsection
