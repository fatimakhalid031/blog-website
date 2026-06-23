@extends('layouts.app')

@section('title', 'Manage Escapes')

@section('content')
<style>
.admin-desk {
    max-width: 860px;
    margin: 0 auto;
    padding: 100px 24px 80px;
}

/* ── Desk header ── */
.desk-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 8px;
    flex-wrap: wrap;
    gap: 16px;
}
.desk-title {
    font-family: 'DM Serif Display', serif;
    font-size: 2rem;
    font-weight: 400;
    color: var(--cream);
    line-height: 1.15;
    letter-spacing: -0.02em;
}
.desk-sub {
    font-size: 0.8rem;
    color: var(--driftwood-light);
    font-style: italic;
    margin-top: 2px;
    font-weight: 400;
}
.desk-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

/* ── Admin Tabs ── */
.desk-tabs {
    display: flex;
    gap: 0;
    margin: 28px 0 32px;
    border-bottom: 1px solid rgba(196,137,90,0.06);
}
.desk-tab {
    padding: 10px 20px;
    font-size: 0.7rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
    text-decoration: none;
    transition: all 0.25s ease;
    border-bottom: 1px solid transparent;
    margin-bottom: -1px;
}
.desk-tab:hover {
    color: var(--cream);
}
.desk-tab.active {
    color: var(--gold);
    border-bottom-color: var(--gold);
}

/* ── Stats row ── */
.desk-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin: 0 0 40px;
}
.desk-stat {
    background: rgba(245,237,224,0.05);
    border: 1px solid rgba(196,137,90,0.06);
    border-radius: 14px;
    padding: 20px 24px;
    text-align: center;
    transition: all 0.3s ease;
}
.desk-stat:hover {
    background: rgba(245,237,224,0.1);
    border-color: rgba(196,137,90,0.2);
    transform: translateY(-3px);
}
.desk-stat-number {
    font-family: 'DM Serif Display', serif;
    font-size: 1.8rem;
    color: var(--gold);
    line-height: 1.1;
    font-weight: 400;
}
.desk-stat-label {
    font-size: 0.6rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    margin-top: 6px;
    font-family: 'Inter', sans-serif;
}

/* ── Table ── */
.desk-table-wrap {
    background: rgba(245,237,224,0.03);
    border: 1px solid rgba(196,137,90,0.06);
    border-radius: 16px;
    overflow: hidden;
}
.desk-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}
.desk-table th {
    text-align: left;
    padding: 16px 20px;
    font-size: 0.6rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    font-weight: 500;
    font-family: 'Inter', sans-serif;
    border-bottom: 1px solid rgba(196,137,90,0.06);
    background: rgba(245,237,224,0.02);
}
.desk-table td {
    padding: 14px 20px;
    border-bottom: 1px solid rgba(196,137,90,0.03);
    color: var(--driftwood-light);
    transition: background 0.2s ease;
    vertical-align: middle;
}
.desk-table tr:last-child td {
    border-bottom: none;
}
.desk-table tr:hover td {
    background: rgba(245,237,224,0.07);
}

.desk-escape-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 0.92rem;
    font-weight: 400;
    color: var(--cream);
    text-decoration: none;
    transition: color 0.25s ease;
    display: block;
    max-width: 260px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.desk-escape-title:hover {
    color: var(--gold-light);
}

.desk-status {
    font-size: 0.6rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    font-family: 'Inter', sans-serif;
    padding: 4px 12px;
    border-radius: 20px;
    display: inline-block;
}
.desk-status-ready {
    color: #8aaa7a;
    background: rgba(138,170,122,0.06);
    border: 1px solid rgba(138,170,122,0.08);
}
.desk-status-processing {
    color: var(--gold);
    background: rgba(196,137,90,0.06);
    border: 1px solid rgba(196,137,90,0.1);
    animation: pulse 1.5s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 0.7; }
    50% { opacity: 1; }
}

.desk-escape-size {
    font-size: 0.75rem;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
}

.desk-thumb {
    width: 56px;
    height: 40px;
    border-radius: 6px;
    overflow: hidden;
    background: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(196,137,90,0.06);
}
.desk-thumb svg {
    width: 16px;
    height: 16px;
    opacity: 0.3;
}

.desk-actions-cell {
    text-align: right;
    white-space: nowrap;
}

/* ── Buttons ── */
.btn-edit {
    display: inline-block;
    padding: 6px 14px;
    border: 1px solid rgba(196,137,90,0.15);
    font-size: 0.65rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.25s ease;
    background: transparent;
    color: var(--driftwood-light);
    border-radius: 8px;
    font-family: 'Inter', sans-serif;
    text-decoration: none;
}
.btn-edit:hover {
    background: rgba(196,137,90,0.06);
    border-color: var(--gold);
    color: var(--gold-light);
    transform: translateY(-1px);
}

.btn-danger-sm {
    display: inline-block;
    padding: 6px 14px;
    border: 1px solid rgba(198,93,71,0.15);
    font-size: 0.65rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.25s ease;
    background: transparent;
    color: rgba(198,93,71,0.7);
    border-radius: 8px;
    font-family: 'Inter', sans-serif;
}
.btn-danger-sm:hover {
    background: rgba(198,93,71,0.06);
    border-color: #c65d47;
    color: #c65d47;
    transform: translateY(-1px);
}

/* ── Empty state ── */
.desk-empty {
    padding: 80px 20px;
    text-align: center;
}
.desk-empty-icon {
    font-size: 2.4rem;
    opacity: 0.1;
    margin-bottom: 12px;
}
.desk-empty-text {
    font-family: 'Caveat', cursive;
    font-size: 1.3rem;
    color: var(--driftwood-light);
    margin-bottom: 6px;
}
.desk-empty-sub {
    font-size: 0.8rem;
    color: var(--driftwood-light);
    margin-bottom: 24px;
}

@media (max-width: 768px) {
    .desk-stats { grid-template-columns: 1fr; }
    .desk-header { flex-direction: column; }
    .desk-table th, .desk-table td { padding: 12px 14px; }
    .desk-escape-title { max-width: 160px; }
}
</style>

<div class="admin-desk">
    {{-- Header --}}
    <div class="desk-header">
        <div>
            <h1 class="desk-title">manage escapes</h1>
            <p class="desk-sub">the videos that slipped through</p>
        </div>
        <div class="desk-actions">
            <a href="{{ route('admin.escapes.create') }}" class="btn btn-sm">Upload New</a>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="desk-tabs">
        <a href="{{ route('admin.index') }}" class="desk-tab">Entries</a>
        <a href="{{ route('admin.escapes.index') }}" class="desk-tab active">Escapes</a>
    </div>

    {{-- Stats --}}
    @if($escapes->count() > 0)
    <div class="desk-stats">
        <div class="desk-stat">
            <div class="desk-stat-number">{{ $escapes->count() }}</div>
            <div class="desk-stat-label">Total escapes</div>
        </div>
        <div class="desk-stat">
            <div class="desk-stat-number">{{ $escapes->where('is_processing', false)->count() }}</div>
            <div class="desk-stat-label">Ready</div>
        </div>
        <div class="desk-stat">
            <div class="desk-stat-number">{{ $escapes->where('is_processing', true)->count() }}</div>
            <div class="desk-stat-label">Processing</div>
        </div>
    </div>
    @endif

    {{-- Table or empty --}}
    @if($escapes->count() > 0)
    <div class="desk-table-wrap">
        <table class="desk-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Size</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($escapes as $escape)
                    <tr>
                        <td style="width: 56px;">
                            <div class="desk-thumb">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <polygon points="5 3 19 12 5 21 5 3" stroke="rgba(196,137,90,0.3)"/>
                                </svg>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('escapes.show', $escape) }}" class="desk-escape-title" title="{{ $escape->title }}">
                                {{ $escape->title }}
                            </a>
                            @if($escape->description)
                                <span style="font-size: 0.7rem; color: var(--driftwood); display: block; margin-top: 2px; max-width: 260px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $escape->description }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($escape->is_processing)
                                <span class="desk-status desk-status-processing">⟳ Converting</span>
                            @else
                                <span class="desk-status desk-status-ready">Ready</span>
                            @endif
                        </td>
                        <td class="desk-escape-size">{{ $escape->formatted_file_size }}</td>
                        <td class="desk-escape-size">{{ $escape->created_at->diffForHumans() }}</td>
                        <td class="desk-actions-cell">
                            <a href="{{ route('admin.escapes.edit', $escape) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('admin.escapes.destroy', $escape) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-sm" onclick="return confirm('Delete this escape? This cannot be undone.')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="desk-empty">
        <div class="desk-empty-icon">🌊</div>
        <div class="desk-empty-text">The shore is quiet.</div>
        <div class="desk-empty-sub">No escapes have been uploaded yet.</div>
        <a href="{{ route('admin.escapes.create') }}" class="btn" style="padding: 10px 24px;">
            Upload your first escape
        </a>
    </div>
    @endif
</div>
@endsection
