<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // products
    // protected $table = 'products';

    protected $fillable = [
        'price',
        'name',
        'weight',
        'status',
        'category_id',
        'image',
        'images'
    ]; // =>
    // protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
