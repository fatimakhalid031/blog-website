<?php

namespace Database\Seeders;

use App\Models\Escape;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class EscapeSeeder extends Seeder
{
    public function run(): void
    {
        $escapes = [
            ['title' => 'Sunset at the harbour', 'description' => 'Golden light fading over quiet waters.'],
            ['title' => 'Waves against the dock', 'description' => 'A gentle rhythm, steady and calm.'],
            ['title' => 'Clouds drifting inland', 'description' => 'Late afternoon light through the mist.'],
        ];

        foreach ($escapes as $i => $data) {
            $filename = 'escapes/dummy-' . ($i + 1) . '.webm';

            // Create a minimal placeholder file
            Storage::disk('public')->put($filename, 'placeholder');

            Escape::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'file_path' => $filename,
                'file_size' => 1024,
                'mime_type' => 'video/webm',
                'is_processing' => false,
            ]);

            $this->command->info('Created: ' . $data['title']);
        }

        $this->command->info('Seeded 3 dummy escapes!');
    }
}
