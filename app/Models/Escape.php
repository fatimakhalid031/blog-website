<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escape extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_size',
        'mime_type',
        'is_processing',
        'original_name',
    ];

    protected function casts(): array
    {
        return [
            'is_processing' => 'boolean',
            'file_size' => 'integer',
        ];
    }

    public function getFormattedFileSizeAttribute(): string
    {
        if (!$this->file_size) return '';
        $bytes = $this->file_size;
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }
}
