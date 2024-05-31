<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryParentController as AdminCategoryParentController;
use App\Http\Controllers\Admin\CategoryProductController as AdminCategoryProductController;
use App\Http\Controllers\Admin\CategoryValueController as AdminCategoryValueController;
use App\Http\Controllers\Admin\CategoryParentProductController as AdminCategoryParentProductController;
// use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\RankController as AdminRankController;
use App\Http\Controllers\Admin\DiscountController as AdminDiscountController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\Product\filterController as ClientFilterController;
use App\Http\Controllers\Client\Product\productController as ClientProductDetailController;
use App\Http\Controllers\Client\Cart\cartController as ClientCartController;
use App\Http\Controllers\Client\profile\accountController as ClientProfileController;

use App\Http\Controllers\MyAuth\AuthController;

// Route::get('/', function () {
//     return view('admin/layouts/master');
// });


Route::prefix('admin')->name('admin.')->group(function (){
    Route::get('/',[AdminDashboardController::class, 'index'])->name('index');
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [AdminProductController::class, 'getList'])->name('getList');

        Route::get('/addCateParent', [AdminProductController::class, 'getAddCateParent'])->name('getAddCateParent');
        Route::post('/addCateParent', [AdminProductController::class, 'postAddCateParent'])->name('postAddCateParent');
        Route::get('/addCateProduct', [AdminProductController::class, 'getAddCateProduct'])->name('getAddCateProduct');
        Route::post('/addCateProduct', [AdminProductController::class, 'postAddCateProduct'])->name('postAddCateProduct');
        Route::get('/add', [AdminProductController::class, 'getAdd'])->name('getAdd');
        Route::post('/add', [AdminProductController::class, 'postAdd'])->name('postAdd');

        Route::get('/updateCateParent/{id}', [AdminProductController::class, 'getUpdateCateParent'])->name('getUpdateCateParent');
        Route::post('/updateCateParent/{id}', [AdminProductController::class, 'postUpdateCateParent'])->name('postUpdateCateParent');
        Route::get('/updateCateProduct/{id}', [AdminProductController::class, 'getUpdateCateProduct'])->name('getUpdateCateProduct');
        Route::post('/updateCateProduct/{id}', [AdminProductController::class, 'postUpdateCateProduct'])->name('postUpdateCateProduct');
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
        Route::get('/categoryValueParent', [AdminCategoryValueController::class, 'getAddCategoryParent'])->name('getAddCategoryParent');
        Route::post('/categoryValueParent', [AdminCategoryValueController::class, 'postAddCategoryParent'])->name('postAddCategoryParent');
        Route::get('/categoryValue', [AdminCategoryValueController::class, 'getAdd'])->name('categoryValueAdd');
        Route::post('/categoryValue', [AdminCategoryValueController::class, 'postAdd'])->name('postcategoryValue');
        Route::get('/updateCategoryValueParent/{id}', [AdminCategoryValueController::class, 'getUpdateCategoryParent'])->name('getUpdateCategoryValueParent');
        Route::post('/updateCategoryValueParent/{id}', [AdminCategoryValueController::class, 'postUpdateCategoryParent'])->name('postUpdateCategoryValueParent');
        Route::get('/updateCategoryValue/{id}', [AdminCategoryValueController::class, 'getUpdate'])->name('getUpdateCategoryValue');
        Route::post('/updateCategoryValue/{id}', [AdminCategoryValueController::class, 'postUpdate'])->name('postUpdateCategoryValue');
        Route::get('/deleteCateValue/{id}', [AdminCategoryValueController::class, 'deleteItem'])->name('deleteCateValue');
        
        Route::get('/categoryParentProductList', [AdminCategoryParentProductController::class, 'getList'])->name('getCategoryParentProduct');
        Route::get('/categoryParentProduct', [AdminCategoryParentProductController::class, 'getAdd'])->name('categoryParentProductAdd');
        Route::post('/categoryParentProduct', [AdminCategoryParentProductController::class, 'postAdd'])->name('postcategoryParentProduct');
        Route::get('/updateCategoryParentProduct/{id}', [AdminCategoryParentProductController::class, 'getUpdate'])->name('getUpdateCategoryParentProduct');
        Route::post('/updateCategoryParentProduct/{id}', [AdminCategoryParentProductController::class, 'postUpdate'])->name('postUpdateCategoryParentProduct');
        Route::get('/deleteCateParentProduct/{id}', [AdminCategoryParentProductController::class, 'deleteItem'])->name('deleteCateParentProduct');
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
    Route::prefix('ranks')->name('ranks.')->group(function () {
        Route::get('/', [AdminRankController::class, 'getList'])->name('getList');
        Route::get('/add', [AdminRankController::class, 'getAdd'])->name('getAdd');
        Route::post('/add', [AdminRankController::class, 'postAdd'])->name('postAdd');
        Route::get('/update/{id}', [AdminRankController::class, 'getUpdate'])->name('getUpdate');
        Route::post('/update/{id}', [AdminRankController::class, 'postUpdate'])->name('postUpdate');
        Route::get('deleteItem/{id}', [AdminRankController::class, 'deleteItem'])->name('delete');
    });
    Route::prefix('discounts')->name('discounts.')->group(function () {
        Route::get('/', [AdminDiscountController::class, 'getList'])->name('getList');
        Route::get('/add', [AdminDiscountController::class, 'getAdd'])->name('getAdd');
        Route::post('/add', [AdminDiscountController::class, 'postAdd'])->name('postAdd');
        Route::get('/update/{id}', [AdminDiscountController::class, 'getUpdate'])->name('getUpdate');
        Route::post('/update/{id}', [AdminDiscountController::class, 'postUpdate'])->name('postUpdate');
        Route::get('deleteItem/{id}', [AdminDiscountController::class, 'deleteItem'])->name('delete');
    });
});

// Routes Client
Route::post('login', [AuthController::class,'login'])->name('login');
Route::post('logout', [AuthController::class,'logout'])->name('logout');
Route::post('register', [AuthController::class,'register'])->name('register');
Route::get('/', [ClientDashboardController::class, 'home'])->name('home');
Route::get('/navbar/{cateParent}/{catePro}', [ClientDashboardController::class, 'navbar'])->name('navbar');
Route::get('/kid', [ClientDashboardController::class, 'kid'])->name('kid');
Route::get('/filter/{cateParent}/{catePro}', [ClientFilterController::class, 'filter'])->name('filter');
Route::get('/filterCategory/{cateParent}/{catePro}/{cateValue}', [ClientFilterController::class, 'filterCategory'])->name('filterCategory');
Route::get('/detail/{id}', [ClientProductDetailController::class,'detail'])->name('detail');
Route::get('/detail/addCart/{idUser}/{idProduct}/{inputAmount}/{selectedSize}', [ClientCartController::class, 'addCart'])->name('addCart');
Route::get('/getCart', [ClientCartController::class, 'getCart'])->name('getCart');
Route::post('/update-cart', [ClientCartController::class, 'updateCart'])->name('update-cart');
Route::get('/cart-summary', [ClientCartController::class, 'getCartSummary'])->name('cart-summary');
Route::post('/remove-cart', [ClientCartController::class, 'removeCart'])->name('remove-cart');
Route::post('/check-discount', [ClientCartController::class, 'checkDiscount'])->name('check-discount');
Route::get('/checkout', [ClientCartController::class, 'checkout'])->name('checkout');
Route::get('/info', [ClientCartController::class, 'info'])->name('info');
Route::post('/info', [ClientCartController::class, 'postInfo'])->name('postInfo');
Route::get('/getAccount', [ClientProfileController::class, 'getAccount'])->name('getAccount');
Route::post('/getAccount', [ClientProfileController::class, 'postAccount'])->name('postAccount');
Route::get('/get-order', [ClientProfileController::class, 'getOrder'])->name('get-order');
Route::get('/get-pending', [ClientProfileController::class, 'getPending'])->name('get-pending');
Route::get('/get-procesing', [ClientProfileController::class, 'getProcessing'])->name('get-processing');
Route::get('/get-ontheway', [ClientProfileController::class, 'getOntheway'])->name('get-ontheway');
Route::get('/get-intransit', [ClientProfileController::class, 'getIntransit'])->name('get-intransit');
Route::get('/get-cancelled', [ClientProfileController::class, 'getCancelled'])->name('get-cancelled');
Route::get('/cancel/{id}', [ClientProfileController::class, 'cancel'])->name('cancel');