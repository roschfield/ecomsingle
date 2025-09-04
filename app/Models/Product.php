<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'slug',
        'category_id',
        'collection_id',
        'image',
        'description',
        'price',
        'is_active',
        'in_stock',
        'stock_quantity',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function collection(){
        return $this->belongsTo(Collection::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
