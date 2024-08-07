<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name',
        'image',
        'price',
        'sale_price',
        'short_description',
        'content',
        'quantity',
        'view',
        'date_add',
        'category_id',
        'status',
        'is_new',
        'is_hot',
        'is_sale',
        'is_show_home',
    ];
    protected $casts = [
        'status' => 'boolean',
        'is_new' => 'boolean',
        'is_hot' => 'boolean',
        'is_sale' => 'boolean',
        'is_show_home' => 'boolean',
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function productImage(){
        return $this->hasMany(ProductImage::class);
    }
}
