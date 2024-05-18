<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;

class CategoryProductController extends Controller
{
    private $categoryProduct;
    public function __construct(){
        $this->categoryProduct = new CategoryProduct();
    }
    public function getList(){
        $title = 'Category Product';
        $list = $this->categoryProduct->getList();
        if(!empty($list)) {
            return view('admin.category.category_product.list',compact('list','title'));
        }
        return view('admin.category.category_product.list',compact('title'));
    }
    public function getAdd(){
        return view('admin.category.category_product.add');
    }
    public function postAdd(Request $req){
        $req ->validate([
            'name' => 'required | unique:categoryproducts',
        ]);
        $data = [
            "name" => $req->name
        ];
        $check = $this->categoryProduct->add($data);
        if($check) {
            return redirect()->route('admin.categories.listCategoryProduct',compact('check'))->with('msg','Add success');
        }
        return redirect()->route('admin.categories.categoryProductAdd');
    }
    public function getUpdate($id=0){
        if(!empty($id) && ctype_digit($id)){
            $category = $this->categoryProduct->getDetail($id);
            if(!empty($category)){
                return view('admin.category.category_product.update', compact('category'));
            }
        }
        return view('admin.category.category_product.update');
    }
    public function postUpdate(Request $req, $id){
        if(!empty($id) && ctype_digit($id)){
            $req->validate([
                'name' => 'required | unique:categoryproducts,name,'.$id
            ]);
            $data = [
                "name" => $req->name
            ];
            $check = $this->categoryProduct->updateItem($id,$data);
            if($check){
                return redirect()->route('admin.categories.listCategoryProduct', compact('check'));
            }
        }
        return redirect()->route('admin.categories.listCategoryProduct');
    }
    public function deleteItem($id = 0){
        if(!empty($id) && ctype_digit($id)){
            $category = $this->categoryProduct::find($id);
            if(!empty($category)){
                if ($category->canBeDeletedProduct()) {
                    if($category->canBeDeletedParentProduct()){
                        if($category->canBeDeleted()){
                            $category->deleteItem($id);
                            return redirect()->route('admin.categories.listCategoryProduct')->with('msg','Deleted Success');    
                        } else {
                            return redirect()->route('admin.categories.listCategoryProduct')->with('error','Không thể xóa category này vì có liên kết với bảng Value');
                        }
                    } else {
                        return redirect()->route('admin.categories.listCategoryProduct')->with('error','Không thể xóa category này vì có liên kết với bảng Parent Product');
                    }
                } else {
                    return redirect()->route('admin.categories.listCategoryProduct')->with('error','Không thể xóa category này vì có liên kết với bảng Product');
                }
            }
        }
        return redirect()->route('admin.categories.listCategoryProduct')->with('error','Không tìm thấy category để xóa');
    }
}
