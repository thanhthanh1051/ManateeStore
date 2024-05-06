<?php
use App\Models\CategoryParent;
use App\Models\CategoryProduct;
use App\Models\CategoryValue;
use App\Models\CategoryParentProduct;
// use App\Models\Brand;
use App\Models\Product;

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
    if($category !== null){
        return $getname->name;
    }
    else{
        return "Category product empty";
    }
}
function getNameCategoryValue($id){
    $category = new CategoryValue();
    $getname = $category->where('id', $id)->first();
    if($category !== null){
        return $category->name;
    }
    else{
        return "Category value empty";
    }
}
// function cateProductFParent($id){
//     $category = CategoryProduct::where('category_parent',$id)->get();
//     if($category != null){
//         return $category;
//     }
//     else{
//         return "Category empty";
//     }
// }

// function getBrand(){
//     $brands = Brand::all();
//     return $brands;
// }
// function getProduct($id){
//     $product = Product::where('category_id', $id)->get();
//     if($product !== null){
//         return $product;
//     }
//     else{
//         return "Product empty";
//     }
// }
// function getProductFCate($id){
//     $category_value = CategoryValue::where('category_product', $id)->get();
//     if($category_value != null){
//         return $category_value;
//     }
//     else{
//         return "Empty";
//     }
// }
function typeSize($id){
    try{
        if($id == "1"){
            return "Size S";
        }
        elseif($id == "2"){
            return "Size M";
        }
        elseif($id == "3"){
            return "Size L";
        }
        else{
            return "Unknown Size";
        }
    }catch(Exception $e){
        return "Empty";
    }
}
