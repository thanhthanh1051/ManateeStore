<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryParent;

class CategoryParentController extends Controller
{
    private $categoryParent;
    public function __construct(){
        $this->categoryParent = new CategoryParent();
    }
    public function getList(){
        $title = 'List of Categories';
        $list = $this->categoryParent->getList();
        if(!empty($list)) {
            return view('admin.category.list',compact('title','list'));
        }
        return view('admin.category.list',compact('title'));
    }
    public function getAdd(){
        $title = 'Add a new catgory';
        return view('admin.category.add',compact('title'));
    }
    public function postAdd(Request $req){
        $req ->validate([
            'name' => 'required | unique:categoryparents'
        ]);
        $data = [
            "name" => $req->name
        ];
        $check = $this->categoryParent->add($data);
        if($check) {
            return redirect()->route('admin.categories.getList',compact('check'));
        }
        return redirect()->route('admin.categories.getList');
    }
    public function getUpdate($id = 0){
        if(!empty($id) && ctype_digit($id)){
            $category = $this->categoryParent->getDetail($id);
            if(!empty($category)){
                return view('admin.category.update', compact('category'));
            }
        }
        return view('admin.category.update');
    }
    public function postUpdate(Request $req, $id){
        if(!empty($id) && ctype_digit($id)){
            $req->validate([
                'name' => 'required | unique:categoryparents,name,'.$id
            ]);
            $data = [
                "name" => $req->name
            ];
            $check = $this->categoryParent->updateItem($id,$data);
            if($check){
                return redirect()->route('admin.categories.getList', compact('check'));
            }
        }
        return redirect()->route('admin.categories.getList');
    }
    public function deleteItem($id = 0){
        if(!empty($id) && ctype_digit($id)){
            $category = CategoryParents::find($id);
            if(!empty($category)){
                if ($category->canBeDeleted()) {
                    $this->categoryParent->deleteItem($id);
                    return redirect()->route('admin.categories.getList')->with('msg','Deleted Success');
                } else {
                    return redirect()->route('admin.categories.getList')->with('error','Không thể xóa category này vì có liên kết với bảng khác');
                }
            }
        }
        return redirect()->route('admin.categories.getList');
    }
}
