<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'alt_text',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function imageUrl(): string
    {
        if (str_starts_with($this->image_path, 'images/')) {
            return asset($this->image_path);
        }

        return asset('storage/' . $this->image_path);
    }
}
