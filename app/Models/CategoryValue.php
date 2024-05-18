<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Product;
use App\Models\CategoryParentProduct;
class CategoryValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    // public function getList(){
    //     $categoryValue = CategoryValue::all();
    //     return $categoryValue;
    // }
    protected $table = 'categoryvalues';
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
    // Định nghĩa quan hệ với bảng categoryvalue
    public function products()
    {
        return $this->hasMany(Product::class, 'category_value', 'id');
    }
    public function canBeDeleted()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryvalue hay không
        return $this->products()->count() === 0;
    }
    public function deleteItem($id){
        return DB::table($this->table)
        ->where('id',$id)->delete();
    }
    public function categoryParentProduct()
    {
        return $this->belongsTo(CategoryParentProduct::class, 'category_id');
    }
}
