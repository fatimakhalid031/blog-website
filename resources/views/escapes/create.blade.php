@extends('layouts.app')

@section('title', 'Upload Escape')

@section('content')
<style>
.upload-page {
    padding: 120px 24px 80px;
    max-width: 640px;
    margin: 0 auto;
}
.upload-title {
    font-family: 'DM Serif Display', serif;
    font-size: 1.8rem;
    font-weight: 400;
    color: var(--cream);
    margin-bottom: 4px;
}
.upload-sub {
    font-size: 0.85rem;
    color: var(--driftwood-light);
    margin-bottom: 36px;
}

/* ── Form card ── */
.upload-card {
    background: rgba(245,237,224,0.03);
    border: 1px solid rgba(196,137,90,0.06);
    border-radius: 16px;
    padding: 36px 36px 32px;
}

.upload-field {
    margin-bottom: 24px;
}
.upload-field label {
    display: block;
    font-size: 0.7rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    margin-bottom: 6px;
    font-family: 'Inter', sans-serif;
}

.upload-input {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid rgba(196,137,90,0.1);
    background: rgba(245,237,224,0.04);
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    color: var(--cream);
    border-radius: 10px;
    transition: all 0.25s ease;
    outline: none;
}
.upload-input:focus {
    border-color: var(--gold);
    background: rgba(245,237,224,0.06);
    box-shadow: 0 0 0 3px rgba(196,137,90,0.06);
}
.upload-input::placeholder {
    color: var(--driftwood);
    opacity: 0.4;
}
textarea.upload-input {
    min-height: 80px;
    resize: vertical;
    font-family: 'Inter', sans-serif;
}

/* ── Drop zone ── */
.drop-zone {
    border: 2px dashed rgba(196,137,90,0.12);
    border-radius: 14px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    background: rgba(245,237,224,0.02);
}
.drop-zone:hover {
    border-color: rgba(196,137,90,0.25);
    background: rgba(245,237,224,0.04);
}
.drop-zone.dragover {
    border-color: var(--gold-light);
    background: rgba(196,137,90,0.06);
    box-shadow: 0 0 30px rgba(196,137,90,0.04);
}
.drop-zone.has-file {
    border-style: solid;
    border-color: var(--gold);
    background: rgba(196,137,90,0.04);
}

.drop-zone-icon {
    font-size: 2rem;
    margin-bottom: 10px;
    opacity: 0.2;
    transition: opacity 0.3s ease;
}
.drop-zone.dragover .drop-zone-icon,
.drop-zone.has-file .drop-zone-icon {
    opacity: 0.4;
}

.drop-zone-text {
    font-size: 0.85rem;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
}
.drop-zone-text strong {
    color: var(--gold-light);
    font-weight: 400;
}
.drop-zone-hint {
    font-size: 0.7rem;
    color: var(--driftwood);
    margin-top: 6px;
}
.drop-zone-filename {
    font-family: 'Inter', sans-serif;
    font-size: 0.8rem;
    color: var(--cream);
    margin-top: 8px;
    display: none;
}
.drop-zone.has-file .drop-zone-filename {
    display: block;
}
.drop-zone.has-file .drop-zone-hint {
    display: none;
}

.drop-zone input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}

/* ── Progress ── */
.upload-progress-wrap {
    display: none;
    margin-top: 16px;
}
.upload-progress-wrap.active {
    display: block;
}
.upload-progress-bar {
    width: 100%;
    height: 4px;
    background: rgba(196,137,90,0.06);
    border-radius: 4px;
    overflow: hidden;
    margin-top: 8px;
}
.upload-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--gold), var(--gold-light));
    border-radius: 4px;
    width: 0%;
    transition: width 0.3s ease;
}
.upload-progress-text {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.75rem;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
}

/* ── Status badge ── */
.upload-status {
    display: none;
    align-items: center;
    gap: 10px;
    padding: 14px 18px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-family: 'Inter', sans-serif;
    margin-top: 16px;
}
.upload-status.active {
    display: flex;
}
.upload-status.loading {
    background: rgba(196,137,90,0.06);
    border: 1px solid rgba(196,137,90,0.08);
    color: var(--driftwood-light);
}
.upload-status.success {
    background: rgba(138,170,122,0.06);
    border: 1px solid rgba(138,170,122,0.08);
    color: #8aaa7a;
}
.upload-status.error {
    background: rgba(198,93,71,0.06);
    border: 1px solid rgba(198,93,71,0.08);
    color: #c65d47;
}

.upload-status-spinner {
    width: 16px;
    height: 16px;
    border: 2px solid rgba(196,137,90,0.15);
    border-top-color: var(--gold);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    flex-shrink: 0;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}

.upload-status-icon {
    flex-shrink: 0;
    font-size: 1.1rem;
}

/* ── Submit button ── */
.upload-btn {
    width: 100%;
    padding: 16px 36px;
    background: var(--gold);
    border: none;
    border-radius: 12px;
    color: white;
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.25s ease;
    margin-top: 8px;
}
.upload-btn:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(196,137,90,0.2);
}
.upload-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}
</style>

<div class="upload-page">
    <h1 class="upload-title">Upload Escape</h1>
    <p class="upload-sub">Drop a quiet moment — any video format, up to 10 MB.</p>

    <div class="upload-card">
        <form id="uploadForm" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="upload-field">
                <label for="title">Title</label>
                <input type="text" id="title" class="upload-input" required placeholder="e.g. Sunset at the harbour" value="{{ old('title') }}">
            </div>

            <div class="upload-field">
                <label for="description">Description <span style="font-weight:300;opacity:0.4;">(optional)</span></label>
                <textarea id="description" class="upload-input" rows="3" placeholder="A quiet moment...">{{ old('description') }}</textarea>
            </div>

            <div class="upload-field">
                <label>Video</label>
                <div class="drop-zone" id="dropZone">
                    <div class="drop-zone-icon">⛅</div>
                    <div class="drop-zone-text">
                        <strong>Choose a video</strong> or drag it here
                    </div>
                    <div class="drop-zone-hint">Any format — MP4, MOV, AVI, WebM & more · Max 64 MB</div>
                    <div class="drop-zone-filename" id="fileName"></div>
                    <input type="file" name="video" id="video" accept="video/*" required>
                </div>
            </div>

            {{-- Progress --}}
            <div class="upload-progress-wrap" id="progressWrap">
                <div class="upload-progress-text">
                    <span id="progressLabel">Uploading...</span>
                    <span id="progressPercent">0%</span>
                </div>
                <div class="upload-progress-bar">
                    <div class="upload-progress-fill" id="progressFill"></div>
                </div>
            </div>

            {{-- Status --}}
            <div class="upload-status" id="uploadStatus">
                <span class="upload-status-spinner" id="statusSpinner"></span>
                <span id="statusMessage"></span>
            </div>

            <button type="submit" class="upload-btn" id="submitBtn">Upload Escape</button>
        </form>
    </div>
</div>

<script>
// ══════════════════════════════════════════════════════════
//  Background upload via Service Worker
//  — upload survives page refresh / navigation
// ══════════════════════════════════════════════════════════

const form = document.getElementById('uploadForm');
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('video');
const fileName = document.getElementById('fileName');
const submitBtn = document.getElementById('submitBtn');
const progressWrap = document.getElementById('progressWrap');
const progressFill = document.getElementById('progressFill');
const progressLabel = document.getElementById('progressLabel');
const progressPercent = document.getElementById('progressPercent');
const uploadStatus = document.getElementById('uploadStatus');
const statusSpinner = document.getElementById('statusSpinner');
const statusMessage = document.getElementById('statusMessage');

// ── Persist form fields across refresh ──
const STORAGE_KEY = 'escape_upload_form';

function saveToStorage() {
    const data = {
        title: document.getElementById('title').value,
        description: document.getElementById('description').value,
    };
    if (data.title || data.description) {
        sessionStorage.setItem(STORAGE_KEY, JSON.stringify(data));
    }
}

function restoreFromStorage() {
    const raw = sessionStorage.getItem(STORAGE_KEY);
    if (!raw) return;
    try {
        const data = JSON.parse(raw);
        if (data.title) document.getElementById('title').value = data.title;
        if (data.description) document.getElementById('description').value = data.description;
    } catch (_) {}
}

function clearStorage() {
    sessionStorage.removeItem(STORAGE_KEY);
}

document.getElementById('title').addEventListener('input', saveToStorage);
document.getElementById('description').addEventListener('input', saveToStorage);
restoreFromStorage();

// ── File selection (picker + drag-drop) ──
let selectedFile = null;

function updateFileLabel() {
    if (selectedFile) {
        const sizeMB = (selectedFile.size / (1024 * 1024)).toFixed(1);
        fileName.textContent = selectedFile.name + ' (' + sizeMB + ' MB)';
        dropZone.classList.add('has-file');
    } else {
        dropZone.classList.remove('has-file');
        fileName.textContent = '';
    }
}

fileInput.addEventListener('change', () => {
    selectedFile = fileInput.files.length > 0 ? fileInput.files[0] : null;
    updateFileLabel();
});

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('dragover');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('dragover');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('dragover');
    if (e.dataTransfer.files.length > 0) {
        selectedFile = e.dataTransfer.files[0];
        try {
            const dt = new DataTransfer();
            dt.items.add(selectedFile);
            fileInput.files = dt.files;
        } catch (_) {}
        updateFileLabel();
    }
});

// ── Status display ──
function setStatus(type, msg) {
    uploadStatus.className = 'upload-status active ' + type;
    statusMessage.textContent = msg;
    statusSpinner.style.display = type === 'loading' ? 'block' : 'none';
}

// ═══════════════════════════════════════════════════════
//  Service Worker ― background upload
// ═══════════════════════════════════════════════════════

// Check if SW is available — fall back to direct XHR upload if not
const swAvailable = 'serviceWorker' in navigator;

// Register SW once (catch silently if not supported on HTTP)
if (swAvailable) {
    navigator.serviceWorker.register('/sw.js').catch(() => {});
}

// ── Listen for messages from the SW ──
if (swAvailable) {
    navigator.serviceWorker.addEventListener('message', (e) => {
        const msg = e.data;
        if (msg.action === 'upload-status') {
            handleSWStatus(msg);
        }
    });
}

// ── Handle status updates from the SW ──
let pollingEscapeId = null;
let pollingTimer = null;

function handleSWStatus(msg) {
    const { id, phase, escapeId, error } = msg;

    if (phase === 'uploading') {
        setStatus('loading', 'Uploading your video…');
        progressLabel.textContent = 'Uploading…';
        progressFill.style.width = '50%';
        progressPercent.textContent = '—';
    }

    if (phase === 'processing') {
        clearStorage();
        progressFill.style.width = '100%';
        progressPercent.textContent = '100%';
        progressLabel.textContent = 'Upload complete!';
        setStatus('loading', 'Converting to WebM…');
        startProcessingPoll(escapeId);
    }

    if (phase === 'error') {
        setStatus('error', '✗ ' + (error || 'Upload failed. Please try again.'));
        submitBtn.disabled = false;
        submitBtn.textContent = 'Try Again';
        progressWrap.classList.remove('active');
    }
}

// ── Poll for processing to finish ──
function startProcessingPoll(escapeId) {
    pollingEscapeId = escapeId;
    let pollCount = 0;
    const MAX_POLLS = 60;
    pollingTimer = setInterval(() => {
        pollCount++;
        if (pollCount > MAX_POLLS) {
            clearInterval(pollingTimer);
            setStatus('success', '✓ Upload complete! It may still be processing.');
            submitBtn.textContent = 'Upload Another';
            submitBtn.disabled = false;
            setTimeout(() => window.location.href = '{{ route("escapes.index") }}', 2000);
            return;
        }
        fetch('/escapes/' + escapeId + '/status')
            .then(r => r.json())
            .then(data => {
                if (!data.is_processing) {
                    clearInterval(pollingTimer);
                    setStatus('success', '✓ Escape uploaded and converted!');
                    submitBtn.textContent = 'Upload Another';
                    submitBtn.disabled = false;
                    setTimeout(() => window.location.href = '{{ route("escapes.index") }}', 2000);
                }
            })
            .catch(() => {});
    }, 2000);
}

// ═══════════════════════════════════════════════════════
//  Check for active uploads on page load (after refresh)
// ═══════════════════════════════════════════════════════
if (swAvailable) {
    // Give the SW a moment to activate, then ask for current uploads
    navigator.serviceWorker.ready.then(() => {
        navigator.serviceWorker.controller?.postMessage({ action: 'get-uploads' });
    });

    // If SW sends us an upload list, pick up where we left off
    navigator.serviceWorker.addEventListener('message', function onList(e) {
        if (e.data.action === 'upload-list' && e.data.uploads.length > 0) {
            const active = e.data.uploads.find(u => u.phase === 'uploading' || u.phase === 'processing');
            if (active) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Uploading…';
                progressWrap.classList.add('active');

                if (active.phase === 'uploading') {
                    setStatus('loading', 'Uploading your video…');
                    progressLabel.textContent = 'Uploading…';
                    progressFill.style.width = '50%';
                    progressPercent.textContent = '—';
                }

                if (active.phase === 'processing' && active.escapeId) {
                    progressFill.style.width = '100%';
                    progressPercent.textContent = '100%';
                    progressLabel.textContent = 'Upload complete!';
                    setStatus('loading', 'Converting to WebM…');
                    startProcessingPoll(active.escapeId);
                }
            }
        }
    }, { once: true });
}

// ═══════════════════════════════════════════════════════
//  Form submit — start upload via SW (or XHR fallback)
// ═══════════════════════════════════════════════════════
form.addEventListener('submit', function(e) {
    e.preventDefault();

    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    const file = selectedFile;

    if (!title) { alert('Please enter a title.'); return; }
    if (!file) { alert('Please select a video.'); return; }
    if (file.size > 64 * 1024 * 1024) {
        alert('File is too large. Maximum is 64 MB.');
        return;
    }

    // ── UI: uploading state ──
    submitBtn.disabled = true;
    submitBtn.textContent = 'Uploading…';
    progressWrap.classList.add('active');
    progressFill.style.width = '0%';
    progressPercent.textContent = '0%';
    progressLabel.textContent = 'Starting…';
    setStatus('loading', 'Starting upload…');

    const tokenInput = document.querySelector('input[name="_token"]');
    if (!tokenInput) {
        setStatus('error', '✗ Session expired. Please refresh the page.');
        submitBtn.disabled = false;
        submitBtn.textContent = 'Refresh & Try Again';
        return;
    }

    // ── Service Worker path ──
    if (swAvailable && navigator.serviceWorker.controller) {
        const uploadId = 'upload_' + Date.now() + '_' + Math.random().toString(36).slice(2, 8);
        const uploadUrl = '{{ route("admin.escapes.store") }}';

        navigator.serviceWorker.controller.postMessage({
            action: 'start-upload',
            id: uploadId,
            file,
            fileName: file.name,
            fileSize: file.size,
            mimeType: file.type,
            title,
            description,
            csrfToken: tokenInput.value,
            url: uploadUrl,
        });

        // The SW will broadcast status updates we handle above
        return;
    }

    // ═══════════════════════════════════════════════════
    //  Fallback: upload via XHR (no SW — older browser)
    // ═══════════════════════════════════════════════════
    const formData = new FormData();
    formData.append('_token', tokenInput.value);
    formData.append('title', title);
    if (description) formData.append('description', description);
    formData.append('video', file);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route("admin.escapes.store") }}');
    xhr.setRequestHeader('Accept', 'application/json');

    xhr.upload.addEventListener('progress', function(e) {
        if (e.lengthComputable) {
            const pct = Math.round((e.loaded / e.total) * 100);
            progressFill.style.width = pct + '%';
            progressPercent.textContent = pct + '%';
        }
    });

    xhr.addEventListener('load', function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            let res;
            try {
                res = JSON.parse(xhr.responseText);
            } catch (_) {
                setStatus('error', '✗ Unexpected server response.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Try Again';
                return;
            }
            if (!res.escape || !res.escape.id) {
                setStatus('error', '✗ Upload failed — invalid server response.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Try Again';
                return;
            }
            clearStorage();
            progressFill.style.width = '100%';
            progressPercent.textContent = '100%';
            progressLabel.textContent = 'Upload complete!';
            setStatus('loading', 'Converting to WebM…');
            startProcessingPoll(res.escape.id);
        } else {
            let msg = 'Upload failed. Please try again.';
            try {
                const err = JSON.parse(xhr.responseText);
                if (err.errors && err.errors.video) msg = err.errors.video[0];
                else if (err.message) msg = err.message;
            } catch(_) {}
            setStatus('error', '✗ ' + msg);
            submitBtn.disabled = false;
            submitBtn.textContent = 'Try Again';
        }
    });

    xhr.addEventListener('error', function() {
        setStatus('error', '✗ Network error. Please check your connection.');
        submitBtn.disabled = false;
        submitBtn.textContent = 'Try Again';
    });

    xhr.send(formData);
});
</script>
@endsection
