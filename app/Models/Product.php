<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\OrderDetail;
use DB;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'images',
        'category_parent',
        'category_product',
        'category_value',
        'amount',
        'size',
        'description',
        'color',
        'price_buy',
        'price_sell'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function orderDetail(){
        return $this->hasMany(OrderDetail::class);
    } 
}
