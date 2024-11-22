<?php

namespace App\Models;

use App\Enum\Product\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
        'is_active',
        'category_id',
    ];

    protected $casts = [
        'is_active' => Status::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
