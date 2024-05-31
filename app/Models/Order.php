<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Discount; 
use DB;
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'total',
        'phone',
        'address',
        'discount_id',
        'status'
    ];

    public function orderDetails(){
        return $this->hasMany(orderDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function discount(){
        return $this->belongsTo(Discount::class);
    }
}
