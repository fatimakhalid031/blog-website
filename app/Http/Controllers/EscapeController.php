<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessEscapeVideo;
use App\Models\Escape;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EscapeController extends Controller
{
    public function index()
    {
        $escapes = Escape::latest()->get();
        return view('escapes.index', compact('escapes'));
    }

    public function create()
    {
        return view('escapes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'video' => 'required|file|mimetypes:video/mp4,video/webm,video/ogg,video/quicktime,video/x-msvideo,video/x-matroska|max:65536',
        ]);

        $file = $request->file('video');
        $path = $file->store('escapes', 'public');

        $escape = Escape::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path' => $path,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'is_processing' => true,
            'original_name' => $file->getClientOriginalName(),
        ]);

        ProcessEscapeVideo::dispatch($escape);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'escape' => [
                    'id' => $escape->id,
                    'title' => $escape->title,
                    'is_processing' => true,
                ],
                'message' => 'Escape uploaded! It will be available shortly.',
            ]);
        }

        return redirect()->route('escapes.index')->with('success', 'Escape uploaded!');
    }

    public function status(Escape $escape)
    {
        return response()->json([
            'id' => $escape->id,
            'is_processing' => $escape->is_processing,
            'title' => $escape->title,
            'file_size' => $escape->formatted_file_size,
            'created_at' => $escape->created_at->diffForHumans(),
        ]);
    }

    public function show(Escape $escape)
    {
        return view('escapes.show', compact('escape'));
    }

    public function adminIndex()
    {
        $escapes = Escape::latest()->get();
        return view('admin.escapes', compact('escapes'));
    }

    public function edit(Escape $escape)
    {
        return view('admin.escapes-edit', compact('escape'));
    }

    public function update(Request $request, Escape $escape)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ]);

        $escape->update($data);

        return redirect()->route('admin.escapes.index')
            ->with('success', 'Escape updated.');
    }

    public function destroy(Escape $escape)
    {
        Storage::disk('public')->delete($escape->file_path);
        $escape->delete();

        return redirect()->route('escapes.index')
            ->with('success', 'Escape deleted.');
    }
}


