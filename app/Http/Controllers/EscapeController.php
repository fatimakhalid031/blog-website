<?php

namespace App\Http\Controllers;

use App\Events\EscapeUploaded;
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
            'video' => 'required|file|mimes:webm|max:10240',
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
        ]);

        ProcessEscapeVideo::dispatch($escape);

        EscapeUploaded::dispatch($escape);

        return redirect()->route('escapes.index')
            ->with('success', 'Escape uploaded! It will be available shortly.');
    }

    public function show(Escape $escape)
    {
        return view('escapes.show', compact('escape'));
    }

    public function destroy(Escape $escape)
    {
        Storage::disk('public')->delete($escape->file_path);
        $escape->delete();

        return redirect()->route('escapes.index')
            ->with('success', 'Escape deleted.');
    }
}
