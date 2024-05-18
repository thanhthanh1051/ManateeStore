<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\CategoryValue;
use App\Models\Product;
class DashboardController extends Controller
{
    public function home(){

        return view('client.home.index');
    }
    public function navbar($cateParent, $catePro){
        $products = Product::where('category_product', $catePro)
                                    ->where('category_parent', $cateParent)
                                    ->get();
        return view('client.navbar.list_product',compact('products','catePro','cateParent'));
    }
    // public function getListProduct($id){
    //     $cateValue = CategoryValue::where('category_product', $id)->get();
    //     foreach($cateValue)
    //     $product = Product::where('category_id',$id)->get();
    //     return view();
    // }
    public function men(){
        return view('kids.index');
    }
}
