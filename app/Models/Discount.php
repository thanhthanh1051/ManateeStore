<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use DB;
class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'price',
        'rank_id',
        'amount'
    ];

    protected $table = 'discounts';
    public function getList(){
        $discount = Discount::all();
        return $discount;
    }
    public function addDiscount($data){
        return Discount::insert($data);
    }
    public function getDetail($id){
        return Discount::where('id',$id)->first();
    }
    public function updateDiscount($id,$data){
        $discount = Discount::where('id',$id)->update($data);
        return $discount;
    }     
    public function getPrice($id){
        if(!empty($id)){
            $price = DB::table($this->table)->where('id',$id)->select('price')->get();
            return $price;
        }
        return 0;
    }
    public function getName($id){
        if(!empty($id)){
            $name = DB::table($this->table)->where('id',$id)->select('name')->get();
            return $name;
        }
        return 0;
    }
    public function deleteItem($id){
        return Discount::where('id',$id)->delete();
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
