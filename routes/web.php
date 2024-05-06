<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryParentController as AdminCategoryParentController;
use App\Http\Controllers\Admin\CategoryProductController as AdminCategoryProductController;
use App\Http\Controllers\Admin\CategoryValueController as AdminCategoryValueController;
use App\Http\Controllers\Admin\CategoryParentProductController as AdminCategoryParentProductController;
// use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\RankController as AdminRankController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\Product\filterController as ClientFilterController;

use App\Http\Controllers\MyAuth\AuthController;

// Route::get('/', function () {
//     return view('admin/layouts/master');
// });


Route::prefix('admin')->name('admin.')->group(function (){
    Route::get('/',[AdminDashboardController::class, 'index'])->name('index');
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [AdminProductController::class, 'getList'])->name('getList');
        Route::get('/add', [AdminProductController::class, 'getAdd'])->name('getAdd');
        Route::post('/add', [AdminProductController::class, 'postAdd'])->name('postAdd');
        Route::get('/update/{id}', [AdminProductController::class, 'getUpdate'])->name('getUpdate');
        Route::post('/update/{id}', [AdminProductController::class, 'postUpdate'])->name('postUpdate');
        Route::get('deleteItem/{id}', [ AdminProductController::class, 'deleteItem'])->name('delete');
        // Route::get('/get-category-products/{categoryId}', [AdminProductController::class, 'getCategoryProduct']);
        Route::get('/get-category-parent-products/{categoryParentId}', [AdminProductController::class, 'getCategoryParentProducts']);
        Route::get('/get-category-values/{categoryParentId}/{categoryProductId}', [AdminProductController::class, 'getCategoryValues']);
    });
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryParentController::class, 'getList'])->name('getList');
        Route::get('/add', [AdminCategoryParentController::class, 'getAdd'])->name('getAdd'); 
        Route::post('/add', [AdminCategoryParentController::class, 'postAdd'])->name('postAdd');
        Route::get('/update/{id}', [AdminCategoryParentController::class, 'getUpdate'])->name('getUpdate');
        Route::post('/update/{id}', [AdminCategoryParentController::class, 'postUpdate'])->name('postUpdate');
        Route::get('deleteItem/{id}', [AdminCategoryParentController::class, 'deleteItem'])->name('delete');
        Route::get('/categoryProductList', [AdminCategoryProductController::class, 'getList'])->name('listCategoryProduct');
        Route::get('/categoryProduct', [AdminCategoryProductController::class, 'getAdd'])->name('categoryProductAdd');
        Route::post('/categoryProduct', [AdminCategoryProductController::class, 'postAdd'])->name('postCategoryProductList');
        Route::get('/updateCategoryProduct/{id}', [AdminCategoryProductController::class, 'getUpdate'])->name('getUpdateCategoryProduct');
        Route::post('/updateCategoryProduct/{id}', [AdminCategoryProductController::class, 'postUpdate'])->name('postUpdateCategoryProduct');
        Route::get('/deleteCateProduct/{id}', [AdminCategoryProductController::class, 'deleteItem'])->name('deleteCatePro');
        Route::get('/categoryValueList', [AdminCategoryValueController::class, 'getList'])->name('categoryValueList');
        Route::get('/categoryValue', [AdminCategoryValueController::class, 'getAdd'])->name('categoryValueAdd');
        Route::post('/categoryValue', [AdminCategoryValueController::class, 'postAdd'])->name('postcategoryValue');
        Route::get('/updateCategoryValue/{id}', [AdminCategoryValueController::class, 'getUpdate'])->name('getUpdateCategoryValue');
        Route::post('/updateCategoryValue/{id}', [AdminCategoryValueController::class, 'postUpdate'])->name('postUpdateCategoryValue');
        Route::get('/deleteCateValue/{id}', [AdminCategoryValueController::class, 'deleteItem'])->name('deleteCateValue');
        Route::get('/categoryParentProductList', [AdminCategoryParentProductController::class, 'getList'])->name('getCategoryParentProduct');
        Route::get('/categoryParentProduct', [AdminCategoryParentProductController::class, 'getAdd'])->name('categoryParentProductAdd');
        Route::post('/categoryParentProduct', [AdminCategoryParentProductController::class, 'postAdd'])->name('postcategoryParentProduct');
        Route::get('/updateCategoryParentProduct/{id}', [AdminCategoryParentProductController::class, 'getUpdate'])->name('getUpdateCategoryParentProduct');
        Route::post('/updateCategoryParentProduct/{id}', [AdminCategoryParentProductController::class, 'postUpdate'])->name('postUpdateCategoryParentProduct');
        Route::get('/deleteCateValue/{id}', [AdminCategoryParentProductController::class, 'deleteItem'])->name('deleteCateParentProduct');
        Route::get('/get-category-products/{categoryParentId}', [AdminCategoryValueController::class, 'getCategoryProduct']);
    });
    // Route::prefix('brands')->name('brands.')->group(function () {
    //     Route::get('/', [AdminBrandController::class, 'getList'])->name('getList');
    //     Route::get('/add', [AdminBrandController::class, 'getAdd'])->name('getAdd');
    //     Route::post('/add', [AdminBrandController::class, 'postAdd'])->name('postAdd');
    //     Route::get('/update/{id}', [AdminBrandController::class, 'getUpdate'])->name('getUpdate');
    //     Route::post('/update/{id}', [AdminBrandController::class, 'postUpdate'])->name('postUpdate');
    //     Route::get('deleteItem/{id}', [AdminBrandController::class, 'deleteItem'])->name('delete');
    // });
    Route::prefix('ranks')->name('rank.')->group(function () {
        Route::get('/', [AdminRankController::class, 'getList'])->name('getList');
        Route::get('/add', [AdminRankController::class, 'getAdd'])->name('getAdd');
        Route::post('/add', [AdminRankController::class, 'postAdd'])->name('postAdd');
        Route::get('/update/{id}', [AdminRankController::class, 'getUpdate'])->name('getUpdate');
        Route::post('/update/{id}', [AdminRankController::class, 'postUpdate'])->name('postUpdate');
        Route::get('deleteItem/{id}', [AdminRankController::class, 'deleteItem'])->name('delete');
    });
});

// Routes Client
Route::post('login', [AuthController::class,'login'])->name('login');
Route::post('register', [AuthController::class,'register'])->name('register');
Route::get('/', [ClientDashboardController::class, 'home'])->name('home');
Route::get('/navbar/{cateParent}/{catePro}', [ClientDashboardController::class, 'navbar'])->name('navbar');
Route::get('/kid', [ClientDashboardController::class, 'kid'])->name('kid');
Route::get('/filter', [ClientFilterController::class, 'filter'])->name('filter');

