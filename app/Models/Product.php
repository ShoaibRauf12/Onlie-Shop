<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sku',
        'barcode',
        'price',
        'compare_price',
        'category_id',
        'sub_category_id',
        'brand_id',
        'is_featured',
        'track_qty',
        'track_quantity',
        'status'
    ];
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function product_images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
}
