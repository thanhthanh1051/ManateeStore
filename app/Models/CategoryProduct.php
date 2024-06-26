<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\CategoryValue;
use App\Models\CategoryParentProduct;
use App\Models\Product;
class CategoryProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    protected $table = 'categoryproducts';
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
    public function products()
    {
        return $this->hasMany(Product::class, 'category_product', 'id');
    }
    public function canBeDeletedProduct()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryvalue hay không
        return $this->products()->count() === 0;
    }
    // Định nghĩa quan hệ với bảng categoryvalue
    public function categoryValues()
    {
        return $this->hasMany(CategoryValue::class, 'category_product', 'id');
    }
    public function canBeDeleted()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryvalue hay không
        return $this->categoryValues()->count() === 0;
    }
    public function categoryParentProducts()
    {
        return $this->hasMany(CategoryParentProduct::class, 'category_product', 'id');
    }
    public function canBeDeletedParentProduct()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryvalue hay không
        return $this->categoryParentProducts()->count() === 0;
    }

    public function deleteItem($id){
        return DB::table($this->table)->where('id',$id)->delete();
    }
}
