<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\CategoryParents;
use App\Models\CategoryProducts;
class CategoryParentProduct extends Model
{
    use HasFactory;
    protected $table = 'categoryparentproducts';
    public function getList(){
        $categories = DB::table($this->table)->get();
        return $categories;
    }
    public function add($data){
        return DB::table($this->table)
        ->insert($data);
    }
    public function getDetail($id){
        return DB::table($this->table)
        ->where('id', $id)
        ->first();
    }
    public function updateItem($id, $data){
        return DB::table($this->table)
        ->where('id',$id)
        ->update($data);
    }
    public function deleteItem($id){
        return DB::table($this->table)->where('id',$id)->delete();
    }
    public function categoryProducts()
    {
        return $this->hasMany(CategoryProduct::class, 'id', 'category_product');
    }
    public function categoryParents()
    {
        return $this->hasMany(CategoryParent::class, 'id', 'category_parent');
    }
    public function canBeDeletedCategoryProduct()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryproduct hay không
        return $this->categoryProducts()->count() === 0;
    }
    public function canBeDeletedCategoryParent()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryproduct hay không
        return $this->categoryParents()->count() === 0;
    }
}
