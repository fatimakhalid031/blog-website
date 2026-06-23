<?php

namespace App\Jobs;

use App\Models\Escape;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessEscapeVideo implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Escape $escape
    ) {}

    public function handle(): void
    {
        $disk = 'public';
        $originalPath = $this->escape->file_path;
        $fullPath = Storage::disk($disk)->path($originalPath);

        if (!file_exists($fullPath)) {
            Log::warning('Escape video not found for processing', ['id' => $this->escape->id, 'path' => $fullPath]);
            $this->escape->update(['is_processing' => false]);
            return;
        }

        // If already WebM, just mark as done
        if (strtolower(pathinfo($originalPath, PATHINFO_EXTENSION)) === 'webm') {
            $this->escape->update([
                'mime_type' => mime_content_type($fullPath) ?: 'video/webm',
                'file_size' => filesize($fullPath),
                'is_processing' => false,
            ]);
            return;
        }

        // Generate WebM path
        $dir = pathinfo($originalPath, PATHINFO_DIRNAME);
        $filename = pathinfo($originalPath, PATHINFO_FILENAME);
        $webmPath = $dir . '/' . $filename . '.webm';
        $webmFullPath = Storage::disk($disk)->path($webmPath);

        // Convert to WebM using FFmpeg
        $ffmpegCmd = sprintf(
            'ffmpeg -i %s -c:v libvpx -b:v 1M -crf 10 -c:a libvorbis -q:a 5 -y %s 2>&1',
            escapeshellarg($fullPath),
            escapeshellarg($webmFullPath)
        );

        exec($ffmpegCmd, $output, $returnCode);

        if ($returnCode !== 0 || !file_exists($webmFullPath)) {
            Log::error('FFmpeg conversion failed', [
                'id' => $this->escape->id,
                'output' => implode("\n", $output),
                'return_code' => $returnCode,
            ]);
            $this->escape->update(['is_processing' => false]);
            return;
        }

        // Delete the original file
        Storage::disk($disk)->delete($originalPath);

        // Update escape with the WebM version
        $this->escape->update([
            'file_path' => $webmPath,
            'mime_type' => 'video/webm',
            'file_size' => filesize($webmFullPath),
            'is_processing' => false,
        ]);
    }
}
