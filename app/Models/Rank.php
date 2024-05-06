<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\User;
use App\Models\Discount;
class Rank extends Model
{
    use HasFactory;
    protected $table = "ranks";
    public function getList(){
        return Rank::all();
    }
    public function add($data){
        return Rank::insert($data);
    }
    public function getDetail($id){
        return Rank::where('id',$id)->first();
    }
    public function updateRank($id,$data){
        return Rank::where('id',$id)->update($data);
    }
    public function users()
    {
        return $this->hasMany(User::class, 'rank_id', 'id');
    }
    public function discounts()
    {
        return $this->hasMany(Discount::class, 'rank_id', 'id');
    }
    public function canBeDeletedUser()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryvalue hay không
        return $this->users()->count() === 0;
    }
    public function canBeDeletedDiscount()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryvalue hay không
        return $this->discounts()->count() === 0;
    }
    public function deleteItem($id){
        return Rank::where('id',$id)->delete();
    }
}
