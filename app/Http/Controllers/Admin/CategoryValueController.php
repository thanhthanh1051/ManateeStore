<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryValue;
use App\Models\CategoryParentProduct;
class CategoryValueController extends Controller
{
    private $categoryvalue;
    public function __construct(){
        $this->categoryValue = new CategoryValue();
    }
    public function getList(){
        $title = 'Category Value';
        $list = $this->categoryValue->getList();
        if(!empty($list)) {
            return view('admin.category.category_value.list',compact('title','list'));
        }
        return view('admin.category.category_value.list',compact('title'));    
    }
    public function getAdd(){
        return view('admin.category.category_value.add');
    }
    public function postAdd(Request $req){
        $req ->validate([
            'name' => 'required',
        ]);
        $category = new CategoryValue;
        $data = [
        "name" => $req->name,
        "category_product" => $req->category_product,
        "category_parent" => $req->category_parent,
        ];
        $check = $this->categoryValue->add($data);
        if($check) {
            return redirect()->route('admin.categories.categoryValueAdd',compact('check'))->with('msg','Add success');
        }
        return redirect()->route('admin.categories.categoryValueAdd');
    }
    public function getUpdate($id = 0){
        if(!empty($id) && ctype_digit($id)){
            $category = $this>categoryValue->getDetail($id);
            if(!empty($category)){
                return view('admin.category.category_value.update', compact('category'));
            }
        }
        return view('admin.category.category_product.update');
    }
    public function postUpdate(Request $req, $id){
        if(!empty($id) && ctype_digit($id)){
            $req->validate([
                'name' => 'required'
            ]); 
            $data = [
                "name" => $req->name,
                "category_product" => $req->category_product,
                "category_parent" => $req->category_parent
            ];
            if(!empty($data)){
                $this->categoryvalue->updateItem($id,$data);
                return redirect()->route('admin.categories.categoryValueList');
            }
        }
        return redirect()->route('admin.categories.categoryValueList');
    }
    public function deleteItem($id = 0){
        if(!empty($id) && ctype_digit($id)){
            $category = categoryValue::find($id);   
            if(!empty($category)){
                if ($category->canBeDeleted()) {
                    $category->delete();
                    return redirect()->route('admin.categories.categoryValueList')->with('msg','Deleted Success');
                } else {
                    // Nếu không thể xóa, chuyển hướng và hiển thị thông báo lỗi
                    return redirect()->route('admin.categories.categoryValueList')->with('error','Không thể xóa category này vì có liên kết với bảng khác');
                }
            }
        }
        return redirect()->route('admin.categories.categoryValueList');
    }
    public function getCategoryProducts(Request $request, $categoryParentId){
        $categoryProducts = CategoryParentProduct::where('category_parent', $categoryParentId)->get();
        return response()->json($categoryProducts);
    }
}
