<?php

namespace App\Jobs;

use App\Models\Escape;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessEscapeVideo implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Escape $escape
    ) {}

    public function handle(): void
    {
        $path = storage_path('app/private/' . $this->escape->file_path);

        if (!file_exists($path)) {
            $this->escape->update(['is_processing' => false]);
            return;
        }

        $mime = mime_content_type($path);
        $size = filesize($path);

        $this->escape->update([
            'mime_type' => $mime,
            'file_size' => $size,
            'is_processing' => false,
        ]);
    }
}
