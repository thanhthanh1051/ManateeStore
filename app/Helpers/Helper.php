<?php
use App\Models\CategoryParent;
use App\Models\CategoryProduct;
use App\Models\CategoryValue;
use App\Models\CategoryParentProduct;
use App\Models\Product;
use App\Models\Cart;
function getNameProduct($id = 0){
    $product = Product::find($id);
    return $product->name;
}
function getCategoryParent(){
    $categories = new CategoryParent();
    return $categories->getList();
}
function getCategoryProduct(){
    $categories = new CategoryProduct();
    return $categories->getList();
}
function getCategoryValue(){
    $categories = new CategoryValue();
    return $categories->getList();
}
function getNameCategoryParent($id){
    $category = new CategoryParent();
    $getname = $category->where('id', $id)->first();
    if($getname !== null){
        return $getname->name;
    }
    else{
        return "Category parent empty";
    }
}
function getNameCategoryProduct($id){
    $category = new CategoryProduct();
    $getname = $category->where('id', $id)->first();
    if($getname !== null){
        return $getname->name;
    }
    else{
        return "Category product empty";
    }
}
function getNameCategoryValue($id){
    $category = new CategoryValue();
    $getname = $category->where('id', $id)->first();
    if($getname !== null){
        return $getname->name;
    }
    else{
        return "Category value empty";
    }
}
function getCategoryProductWParent($categoryParentId){
    $categoryProducts = CategoryParentProduct::where('category_parent', $categoryParentId)->get();
    return $categoryProducts;
}
function getCategoryValueofProduct($cateParent, $cateProduct){
    $categoryValue = CategoryValue::where('category_parent', $cateParent)
                                    ->where('category_product', $cateProduct)
                                    ->get();
    return $categoryValue;
}

function typeSize($id){
    try{
        if($id == "1"){
            return "S";
        }
        elseif($id == "2"){
            return "M";
        }
        elseif($id == "3"){
            return "L";
        }
        else{
            return "Unknown Size";
        }
    }catch(Exception $e){
        return "Empty";
    }
}
function cateProductFParent($idCateParent){
    $cateParentProduct = CategoryParentProduct::where('category_parent', $idCateParent)->get();
    return $cateParentProduct;
}
function getProductToCategoryValue($id){

}
function getCategoryValueToParentProduct($cateParent,$cateProduct){
    $cateValue = CategoryValue::where('category_parent', $cateParent)
                            ->where('category_product', $cateProduct)
                            ->get();
                            return $cateValue;
}
function getAmountCart(){
    if(isset(Auth::user()->id)){
        $user = Auth::user()->id;
        $cart = Cart::where('user_id',$user)->sum('amount');
        // if($cart && $cart->amount != null){
        //     $amount = $cart->amount;
        //     return $amount;
        // }
        return $cart;
    }
    return 0;
}
function getItemAmountCart($idProduct){
    if(Auth::check()){
        $user = Auth::user()->id;
        $cart = Cart::where('user_id', $user)
                    ->where('product_id', $idProduct)
                    ->first();
        $amount = $cart->amount;
        return $amount;
    }
    return 0;
}

function getItemSizeCart($idProduct){
    if(Auth::check()){
        $user = Auth::user()->id;
        $cart = Cart::where('user_id', $user)
                    ->where('product_id', $idProduct)
                    ->first();
        $size = $cart->size;
        if($size == "1"){
            return "S";
        }
        elseif($size == "2"){
            return "M";
        }
        elseif($size == "3"){
            return "L";
        }
        else{
            return "Unknown Size";
        }
    }
    return 0;
}
function getTotalPrice(){
    if(Auth::check()){
        $user = Auth::user()->id;
        $cart = Cart::where('user_id', $user)
                    ->first();
        $key = 0;
        foreach($cart as $item){
            $key = $item->prouduct * $item->amount;
        }
    }
    return $key;
}