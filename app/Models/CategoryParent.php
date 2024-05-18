<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\CategoryProduct;
class CategoryParent extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    protected $table = 'categoryparents';
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
    public function categoryValues()
    {
        return $this->hasMany(CategoryValue::class, 'category_parent', 'id');
    }
    public function canBeDeleted()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryproduct hay không
        return $this->categoryValues()->count() === 0;
    }
    public function categoryParentProduct()
    {
        return $this->hasMany(CategoryParentProduct::class, 'category_parent', 'id');
    }
    public function canBeDeletedParentProduct()
    {
        // Kiểm tra xem mô hình có liên kết với bất kỳ bản ghi nào trong bảng categoryproduct hay không
        return $this->categoryParentProduct()->count() === 0;
    }
    public function deleteItem($id){
        return DB::table($this->table)->where('id',$id)->delete();
    }
}
