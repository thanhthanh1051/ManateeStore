<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Product;
// class Brand extends Model
// {
//     use HasFactory;
//     protected $fillable = [
//         'name',
//         'description',
//     ];
//     protected $table = 'brands';
//     public function getList(){
//         $brands = brands::all();
//         return $brands;
//     }
//     public function add($data){
//         return brands::insert($data);
//     }
//     public function getDetail($id){
//         return DB::table($this->table)
//         ->where('id', $id)
//         ->first();
//     }
//     public function updateItem($id, $data){
//         return brands::where('id',$id)->update($data);
//     }
//     public function brands()
//     {
//         return $this->hasMany(Product::class, 'brand_id', 'id');
//     }
//     public function canBeDeleted()
//     {
//         // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryproduct hay không
//         return $this->brands()->count() === 0;
//     }
//     public function deleteItem($id){
//         return brands::where('id',$id)->delete();
//     }
// }
