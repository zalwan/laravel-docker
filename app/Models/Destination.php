<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $region
 * @property string $description
 * @property string $image
 * @property float $ticket_price
 */
class Destination extends Model
{
    protected $fillable = [
        'name',
        'region',
        'description',
        'image',
        'ticket_price',
    ];

    protected $casts = [
        'ticket_price' => 'decimal:2',
    ];
}
