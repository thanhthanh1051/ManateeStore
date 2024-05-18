<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
// use App\Models\Brand;
use App\Models\CategoryParent;
use App\Models\CategoryProduct;
use App\Models\CategoryValue;
class ProductController extends Controller
{
    public function getList(){
        $title = 'List of Products';
        $list = Product::all();
        $category = CategoryParent::all();
        if(!empty($list)) {
            return view('admin.product.list', compact('title','list'));
        }
        return view('admin.product.list',compact('title'));
    }
    public function getAdd() {
        $title = 'Add a new product';
        return view('admin.product.add',compact('title'));
    }
    public function getAddCateParent() {
        $title = 'Add a new product';
        return view('admin.product.add_CateParent',compact('title'));
    }
    public function postAddCateParent(Request $req){
        $req ->validate([
            'categoryparent' => 'required | regex:/^(?!0$).*/'
        ]);
        $cateParent = $req->categoryparent;
        return view('admin.product.add_CateProduct',compact('cateParent'));
    }
    public function getAddCateProduct() {
        $title = 'Add a new product';
        return view('admin.product.add_CateProduct ',compact('title'));
    }
    public function postAddCateProduct(Request $req){
        $req ->validate([
            'categoryproduct' => 'required | regex:/^(?!0$).*/'
        ]);
        $cateParent = $req->categoryparent;
        $cateProduct = $req->categoryproduct;
        return view('admin.product.add',compact('cateParent','cateProduct'));
    }
    public function postAdd(Request $req){
        $req ->validate([  
            'code' => 'required | unique:products',
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'categoryparent' => 'required | regex:/^(?!0$).*/',
            'categoryproduct' => 'required | regex:/^(?!0$).*/',
            'categoryvalue' => 'required | regex:/^(?!0$).*/',
            'amount' => 'required | integer | min:1',
            'description' => 'required',
            'color' => 'required',
            'price_buy' => 'required | integer | min:100',
            'price_sell' => 'required | integer | min:100',
        ]);
        // $imageName = $req->file('image')->getClientOriginalName();
        // $path = $req->file('image')->storeAs('images',$imageName,'public');
        // $pathImage = '/storage'.'/'.$path;

        // Xử lý hình ảnh
        $filename = '';
        $filename = $req->getSchemeAndHttpHost() . '/assets/images/' . time() . '.' .$req->image->extension();
        $req->image->move(public_path('/assets/images/'),$filename);

        // Lấy danh sách các size đã chọn và nối chúng thành một chuỗi
        $sizes = is_array($req->input('size')) ? implode(',', $req->input('size')) : $req->input('size', '');

        $product = new Product;
        $product->code = $req->code;
        $product->name = $req->name;    
        $product->images = $filename;
        $product->category_parent = $req->categoryparent;
        $product->category_product = $req->categoryproduct;
        $product->category_value = $req->categoryvalue;
        $product->amount = $req->amount;
        $product->size = $sizes;
        $product->description = $req->description;
        $product->color = $req->color;
        $product->price_buy = $req->price_buy;
        $product->price_sell = $req->price_sell;
        $check = $product->save();
        if($check) {
            return redirect()->route('admin.products.getList')->with('msg','Thêm sản phẩm thành công');
        }
        return redirect()->route('admin.products.getList')->with('error','Thêm sản phẩm thất bại');
    }
    public function getUpdate($id =0) {
        if(!empty($id) && ctype_digit($id)){
            $product = Product::find($id);
            if(!empty($product)) {
                return view('admin.product.update', compact('product','id'));
            }
        }
        return view('admin.product.update');
    }
    public function getUpdateCateParent($id =0) {
        if(!empty($id) && ctype_digit($id)){
            $product = Product::find($id);
            if(!empty($product)) {
                return view('admin.product.update_CateParent', compact('product','id'));
            }
        }
        return view('admin.product.update');
    }
    public function postUpdateCateParent(Request $req, $id){
        if(!empty($id) && ctype_digit($id)){
            $req ->validate([
                'categoryparent' => 'required | regex:/^(?!0$).*/'
            ]);
            $cateParent = $req->categoryparent;
            return view('admin.product.update_CateProduct',compact('cateParent','id'));
        }
    }
    public function getUpdateCateProduct($id =0) {
        if(!empty($id) && ctype_digit($id)){
            $product = Product::find($id);
            if(!empty($product)) {
                return view('admin.product.update_CateProduct', compact('product','id'));
            }
        }
        return view('admin.product.update_CateProduct');
    }
    public function postUpdateCateProduct(Request $req, $id = 0){
        $req ->validate([
            'categoryproduct' => 'required | regex:/^(?!0$).*/'
        ]);
        if(!empty($id) && ctype_digit($id)){
            $product = Product::find($id);
        }
        $cateParent = $req->categoryparent;
        $cateProduct = $req->categoryproduct;
        return view('admin.product.update',compact('cateParent','cateProduct','id','product'));
    }
    public function postUpdate(Request $req, $id){
    if(!empty($id) && ctype_digit($id)){
        $req ->validate([
            'code' => 'required | unique:products,code,'.$id,
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'categoryparent' => 'required | regex:/^(?!0$).*/',
            'categoryproduct' => 'required | regex:/^(?!0$).*/',
            'categoryvalue' => 'required | regex:/^(?!0$).*/',
            'amount' => 'required | integer | min:1',
            'description' => 'required',
            'color' => 'required',
            'price_buy' => 'required | integer | min:100',
            'price_sell' => 'required | integer | min:100',
        ]);
        // Xử lý hình ảnh
        $filename = '';
        $filename = $req->getSchemeAndHttpHost() . '/assets/images/' . time() . '.' .$req->image->extension();
        $req->image->move(public_path('/assets/images/'),$filename);

        // Lấy danh sách các size đã chọn và nối chúng thành một chuỗi
        $sizes = is_array($req->input('size')) ? implode(',', $req->input('size')) : $req->input('size', '');

        $product = Product::find($id);
        $product->code = $req->code;
        $product->name = $req->name;    
        $product->images = $filename;
        $product->category_parent = $req->categoryparent;
        $product->category_product = $req->categoryproduct;
        $product->category_value = $req->categoryvalue;
        $product->amount = $req->amount;
        $product->size = $sizes;
        $product->description = $req->description;
        $product->color = $req->color;
        $product->price_buy = $req->price_buy;
        $product->price_sell = $req->price_sell;
        $check = $product->save();
        if($check) {
            return redirect()->route('admin.products.getList')->with('msg','Cập nhật sản phẩm thành công');
        }
    }
        return redirect()->route('admin.products.getList');
    }
    public function deleteItem($id=0){
        if(!empty($id) && ctype_digit($id)){
            $product = Product::find($id);
            if(!empty($product)) {
                $check = $product->delete();
                if($check) {
                    return redirect()->route('admin.products.getList',compact('check'))->with('msg','Xóa sản phẩm thành công');
                }
            }
        }
        return redirect()->route('admin.products.getList')->with('error','Xóa sản phẩm thất bại');
    }
    public function getCategoryParentProducts(Request $request, $categoryParentId)
    {
    $categoryParentProducts = CategoryParentProduct::where('category_parent', $categoryParentId)->get();

    return response()->json($categoryParentProducts);
    }

    public function getCategoryValues(Request $request, $categoryParentId, $categoryProductId)
    {
    $categoryValues = CategoryValue::whereHas('categoryParentProduct', function($query) use ($categoryParentId, $categoryProductId) {
        $query->where('category_parent', $categoryParentId)
              ->where('category_product', $categoryProductId);
    })->get();
    
    return response()->json($categoryValues);
    }
}  
