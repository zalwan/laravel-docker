<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property ?string $description
 * @property ?array $teknologi
 * @property ?string $image
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'teknologi',
        'image',
        'status',
    ];

    protected $casts = [
        'teknologi' => 'array',
    ];
}
