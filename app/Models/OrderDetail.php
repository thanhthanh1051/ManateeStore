<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order; 
use DB;
class OrderDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'price'
    ];

    protected $table = "orderdetail";

    public function add($data){
        return DB::table($this->table)
        ->insert($data);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
