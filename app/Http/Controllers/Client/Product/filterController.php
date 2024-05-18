<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class filterController extends Controller
{
    public function filter(Request $req, $cateParent, $catePro) {
        $color = $req->color;
        $category_value = $req->category;
        $sizes = is_array($req->input('size')) ? implode(',', $req->input('size')) : $req->input('size', '');
        $query = Product::query();
        // dd($cateParent);
        if($cateParent){
            $query->where('category_parent', $cateParent);
        }
        if($catePro){
            $query->where('category_product', $catePro);
        }
        if ($category_value) {
            $query->where('category_value', $category_value);
        }
        if ($color) {
            $query->where('color', $color);
        }
        if ($sizes) {
            $query->where('size', $sizes);
        }

        $products = $query->get();

        return view('client.filter.showProduct',compact('products', 'cateParent', 'catePro'));
    }
    public function filterCategory($cateParent, $catePro, $cateValue) {
        $query = Product::query();
        if($cateParent){
            $query->where('category_parent', $cateParent);
        }
        if($catePro){
            $query->where('category_product', $catePro);
        }
        if ($cateValue) {
            $query->where('category_value', $cateValue);
        }
        $products = $query->get();

        return view('client.filter.showProduct',compact('products', 'cateParent', 'catePro', 'cateValue'));
    }
}
