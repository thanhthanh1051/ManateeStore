<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class productController extends Controller
{
    public function detail($id = 0){
        $product = Product::find($id);
        return view('client.product.detail',compact('product','id'));
    }
}
