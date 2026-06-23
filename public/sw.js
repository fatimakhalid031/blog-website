// ── Service Worker: Background Escape Upload ──
// Uploads survive page refresh / navigation because the SW
// keeps the fetch alive independently of the page.

const uploads = new Map();

self.addEventListener('install', () => self.skipWaiting());
self.addEventListener('activate', (e) => e.waitUntil(clients.claim()));

// ── Helper: broadcast to all visible SW clients ──
function broadcast(msg) {
  self.clients.matchAll().then((clients) => {
    clients.forEach((c) => c.postMessage(msg));
  });
}

// ── Handle upload tasks from the page ──
self.addEventListener('message', async (e) => {
  const { action } = e.data;

  if (action === 'start-upload') {
    const {
      id, file, fileName, fileSize, mimeType,
      title, description, csrfToken, url,
    } = e.data;

    // Register in active-uploads map
    uploads.set(id, { id, fileName, fileSize, phase: 'uploading' });
    broadcast({ action: 'upload-status', id, phase: 'uploading' });

    // Build multipart form-data
    const formData = new FormData();
    formData.append('_token', csrfToken);
    formData.append('title', title);
    if (description) formData.append('description', description);
    formData.append('video', file, fileName);

    try {
      const response = await fetch(url, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
        headers: { Accept: 'application/json' },
      });

      if (!response.ok) {
        // Try to parse server error
        let msg = 'Upload failed';
        try { const err = await response.json(); msg = err.message || err.errors?.video?.[0] || msg; } catch (_) {}
        uploads.set(id, { ...uploads.get(id), phase: 'error', error: msg });
        broadcast({ action: 'upload-status', id, phase: 'error', error: msg });
        return;
      }

      const data = await response.json();

      if (!data.escape || !data.escape.id) {
        uploads.set(id, { ...uploads.get(id), phase: 'error', error: 'Invalid server response' });
        broadcast({ action: 'upload-status', id, phase: 'error', error: 'Invalid server response' });
        return;
      }

      // Upload succeeded — enter processing phase
      uploads.set(id, {
        ...uploads.get(id),
        phase: 'processing',
        escapeId: data.escape.id,
      });
      broadcast({
        action: 'upload-status',
        id,
        phase: 'processing',
        escapeId: data.escape.id,
      });
    } catch (err) {
      uploads.set(id, { ...uploads.get(id), phase: 'error', error: err.message });
      broadcast({ action: 'upload-status', id, phase: 'error', error: err.message });
    }
  }

  // ── Page asking for current uploads (after refresh) ──
  if (action === 'get-uploads') {
    e.source.postMessage({
      action: 'upload-list',
      uploads: Array.from(uploads.values()),
    });
  }
});
