<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedCity extends Model
{
    use HasFactory;

    protected $table = 'supported_cities';

    protected $fillable = [
        'name',
        'is_active',
        'shipping_fee',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'shipping_fee' => 'decimal:2',
    ];
}
