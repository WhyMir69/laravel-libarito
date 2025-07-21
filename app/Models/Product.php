<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
        'product_code',
=======
        'code',
>>>>>>> 4db59ba1938de0e418ef7c0900ff3dbdfa47e0ec
        'name',
        'quantity',
        'price',
        'description',
<<<<<<< HEAD
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
=======
        'image'
    ];
>>>>>>> 4db59ba1938de0e418ef7c0900ff3dbdfa47e0ec
}
