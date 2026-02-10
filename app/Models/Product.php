<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'image',
        'product_name',
        'barcode',
        'price',
        'discounted',
        'status',
        'stocks',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'price'      => 'decimal:2',
        'discounted' => 'decimal:2',
        'stocks'     => 'integer',
    ];

    /**
     * Default attribute values.
     */
    protected $attributes = [
        'status' => 'active',
        'stocks' => 0,
    ];
}
