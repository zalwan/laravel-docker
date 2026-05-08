<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $section
 * @property ?string $title
 * @property ?string $description
 * @property ?string $value
 * @property ?string $label
 * @property ?array $items
 * @property int $sort_order
 */
class CompanyContent extends Model
{
    protected $fillable = [
        'section',
        'title',
        'description',
        'value',
        'label',
        'items',
        'sort_order',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
