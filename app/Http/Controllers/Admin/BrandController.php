<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Brand;

// class BrandController extends Controller
// {
//     public function getList(){
//         $title = 'List of Categories';
//         $list = Brand::all();
//         if(!empty($list)) {
//             return view('admin.brands.list',compact('title','list'));
//         }
//         return view('admin.brands.list',compact('title'));
//     }
//     public function getAdd(){
//         $title = 'Add a new brand';
//         return view('admin.brands.add',compact('title'));
//     }
//     public function postAdd(Request $req){
//         $req ->validate([
//             'name' => 'required | unique:brands'
//         ]);
//         $brand = new Brand;
//         $brand->name = $req->name;
//         $brand->description = $req->description;
//         $check = $brand->save();
//         if($check) {
//             return redirect()->route('admin.brands.getList',compact('check'))->with('msg','Add Brand Success');
//         }
//         return redirect()->route('admin.brands.getList')->with('error', 'Add faild, check please!');
//     }
//     public function getUpdate($id = 0){
//         if(!empty($id) && ctype_digit($id)){
//             $brand = Brand::find($id);
//             if(!empty($brand)){
//                 return view('admin.brands.update', compact('brand'));
//             }
//         }
//         return view('admin.brands.update');
//     }
//     public function postUpdate(Request $req, $id){
//         if(!empty($id) && ctype_digit($id)){
//             $req->validate([
//                 'name' => 'required | unique:brands,name,'.$id
//             ]);
//             $brand = Brand::find($id);
//             if(!empty($brand)){
//                 $brand->name = $req->name;
//                 $brand->description = $req->description;
//                 $check = $brand->save();
//                 if($check){
//                     return redirect()->route('admin.brands.getList', compact('check'));
//                 }
//             }
//         }
//         return redirect()->route('admin.brands.getList');
//     }
//     public function deleteItem($id = 0){
//         if(!empty($id) && ctype_digit($id)){
//             $brand = Brand::find($id);
//             if(!empty($brand)){
//                 if ($brand->canBeDeleted()) {
//                     $brand->delete();
//                     return redirect()->route('admin.brands.getList')->with('msg','Deleted Success');
//                 } else {
//                     return redirect()->route('admin.brands.getList')->with('error','Không thể xóa brand này vì có liên kết với bảng khác');
//                 }
//             }
//         }
//         return redirect()->route('admin.brands.getList');
//     }
// }
