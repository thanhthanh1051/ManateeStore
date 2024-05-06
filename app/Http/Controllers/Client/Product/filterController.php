<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class filterController extends Controller
{
    public function filter(Request $req) {
        $color = $req->color;
        $category = $req->category;
        $sizes = is_array($req->input('size')) ? implode(',', $req->input('size')) : $req->input('size', '');
        $query = Product::query();
        if ($category) {
            $query->where('category_id', $category);
        }
        if ($color) {
            $query->where('color', $color);
        }
        if ($sizes) {
            $query->where('size', $sizes);
        }
        $productFilter = $query->get();

        return view('client.filter.showProduct',compact('productFilter', 'category'));
    }
    
}
