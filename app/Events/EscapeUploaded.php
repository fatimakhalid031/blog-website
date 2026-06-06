<?php

namespace App\Events;

use App\Models\Escape;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EscapeUploaded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Escape $escape,
        public string $status = 'uploaded'
    ) {}

    public function broadcastOn(): array
    {
        return [
            new Channel('escapes'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'escape.uploaded';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->escape->id,
            'title' => $this->escape->title,
            'status' => $this->status,
            'file_size' => $this->escape->formatted_file_size,
            'created_at' => $this->escape->created_at->diffForHumans(),
        ];
    }
}
