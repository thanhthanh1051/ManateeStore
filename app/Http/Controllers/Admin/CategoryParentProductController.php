<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryParentProduct;
class CategoryParentProductController extends Controller
{
    private $categoryParentProduct;
    public function __construct(){
        $this->categoryParentProduct = new CategoryParentProduct();
    }
    public function getList(){
        $title = 'List of Category Parent Products';
        $list = $this->categoryParentProduct->getList();
        if(!empty($list)) {
            return view('admin.category.category_parent_product.list',compact('title','list'));
        }
        return view('admin.category.category_parent_product.list',compact('title'));
    }
    public function getAdd(){
        $title = 'Add a new catgory parent product';
        return view('admin.category.category_parent_product.add',compact('title'));
    }
    public function postAdd(Request $req){
        $existingPair = $this->categoryParentProduct->where('category_parent', $req->category_parent)
                                              ->where('category_product', $req->category_product)
                                              ->exists();

        if ($existingPair) {
            return redirect()->back()->with('error', 'This category parent and product pair already exists.');
        }
        $categoryparentproduct = new CategoryParentProduct;
        $data = [
            "category_parent" => $req->category_parent,
            "category_product" => $req->category_product
        ];
        $check = $this->categoryParentProduct->add($data);
        if($check) {
            return redirect()->route('admin.categories.getCategoryParentProduct');
        }
        return redirect()->route('admin.categories.getCategoryParentProduct');
    }
    public function getUpdate($id = 0){
        if(!empty($id) && ctype_digit($id)){
            $category = $this->categoryParentProduct->getDetail($id);
            if(!empty($category)){
                return view('admin.category.categoryparentproduct.update', compact('category'));
            }
        }
        return view('admin.category.categoryparentproduct.update');
    }
    public function postUpdate(Request $req, $id){
        if(!empty($id) && ctype_digit($id)){
            $existingPair = $this->categoryParentProduct->where('category_parent', $req->category_parent)
                                              ->where('category_product', $req->category_product)
                                              ->exists();

            if ($existingPair) {
                return redirect()->back()->with('error', 'This category parent and product pair already exists.');
            }
            $data = [
                "category_parent" => $req->category_parent,
                "category_product" => $req->category_product
            ];
            $check = $this->categoryParentProduct->updateItem($id,$data);
            if($check){
                return redirect()->route('admin.categories.getCategoryParentProduct');
            }
        }
        return redirect()->route('admin.categories.getCategoryParentProduct');
    }
    public function deleteItem($id = 0){
        if(!empty($id) && ctype_digit($id)){
                if ($this->categoryParentProduct->canBeDeletedCategoryProduct()) {
                    if($this->categoryParentProduct->canBeDeletedCategoryParent())
                    {
                        $this->categoryParentProduct->deleteItem($id);
                        return redirect()->route('admin.categories.getCategoryParentProduct')->with('msg','Deleted Success');
                    }else{
                        return redirect()->route('admin.categories.getCategoryParentProduct')->with('error','Không thể xóa category này vì có liên kết với bảng category parent');
                    }
                } else {
                    return redirect()->route('admin.categories.getCategoryParentProduct')->with('error','Không thể xóa category này vì có liên kết với bảng category product');
                }
        }
        return redirect()->route('admin.categories.getCategoryParentProduct');
    }
}
