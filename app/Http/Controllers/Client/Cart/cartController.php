<?php

namespace App\Http\Controllers\Client\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class cartController extends Controller
{
    public function getCart()
    {
        if (Auth::check()) {
        // Lấy tất cả các mục giỏ hàng của người dùng
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        
        // Tạo một mảng để lưu trữ thông tin sản phẩm
        $products = [];

        // Lặp qua từng mục giỏ hàng và lấy thông tin sản phẩm tương ứng
        // foreach ($cartItems as $cartItem) {
        //     $product = Product::find($cartItem->product_id);
        //     if ($product) {
        //         $products[] = $product;
        //     }
        // }
        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
            if ($product) {
                // Tạo một bản sao của sản phẩm để lưu thông tin kích thước và số lượng trong giỏ hàng
                $productCopy = clone $product;
                $productCopy->cart_amount = $cartItem->amount;
                $productCopy->cart_size = $cartItem->size;
                $products[] = $productCopy;
            }
        }
        
        // Trả về view và truyền danh sách sản phẩm vào view
        return view('client.cart.index', compact('products'));
    }
    
    // Nếu người dùng chưa đăng nhập, trả về view trống
    return view('client.cart.index');
}
  
    public function addCart($idUser, $idProduct, $inputAmount, $selectedSize)
    {
        $product = Product::find($idProduct);
        
        // Kiểm tra xem sản phẩm có tồn tại không
        if ($product != null) {
            // Tìm sản phẩm trong giỏ hàng của người dùng
            $cartItem = Cart::where('user_id', $idUser)
                            ->where('product_id', $idProduct)
                            ->where('size', $selectedSize)
                            ->first();

            if ($cartItem) {
                // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
                $cartItem->amount += $inputAmount;
            } else {
                // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới
                $cartItem = new Cart();
                $cartItem->user_id = $idUser;
                $cartItem->product_id = $idProduct;
                $cartItem->size = $selectedSize;
                $cartItem->amount = $inputAmount;
            }
            
            // Lưu thay đổi vào cơ sở dữ liệu
            $cartItem->save();
            $totalAmount = Cart::where('user_id', Auth::id())->sum('amount');
            // Trả về số lượng sản phẩm trong giỏ hàng để cập nhật trên giao diện
            return $totalAmount;
        } else {
            // Trả về thông báo lỗi nếu sản phẩm không tồn tại
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function updateCart(Request $request)
    {
        $itemId = $request->input('item_id');
        $size = $request->input('size');
        $quantity = $request->input('quantity');

        $cart = Cart::where('user_id', Auth()->id())->where('product_id', $itemId)->first();

        // if ($cart) {
        //     $cart->amount = $quantity;
        //     $cart->save();
        $cartItem = Cart::where('user_id', Auth::id())
                    ->where('product_id', $itemId)
                    ->where('size', $size)
                    ->first();

        if ($cartItem) {
            $cartItem->amount = $quantity;
            $cartItem->save();

            $totalAmount = Cart::where('user_id', Auth::id())->sum('amount');
            $cartSummary = $this->getCartSummaryData();

            return response()->json(['success' => true, 'totalAmount' => $totalAmount, 'cartSummary' => $cartSummary]);
        }

        return response()->json(['success' => false], 404);
    }
    public function removeCart(Request $request){
        $itemId = $request->input('item_id');

        // $cart = Cart::where('user_id', Auth()->id())->where('product_id', $itemId)->first();
        $size = $request->input('item_size');

        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $itemId)
                        ->where('size', $size)
                        ->first();


        if ($cartItem) {
            $cartItem->delete();

            $totalAmount = Cart::where('user_id', Auth::id())->sum('amount');
            $cartSummary = $this->getCartSummaryData();

            return response()->json(['success' => true, 'totalAmount' => $totalAmount, 'cartSummary' => $cartSummary]);
        }

        return response()->json(['success' => false], 404);
    }
    // public function getCartSummary() {
    //     $cartItems = Cart::where('user_id', Auth::id())->get();
    //     $products = [];
    //     $totalAmount = 0;
    
    //     foreach ($cartItems as $cartItem) {
    //         $product = Product::find($cartItem->product_id);
    //         if ($product) {
    //             $productData = [
    //                 'name' => $product->name,
    //                 'price' => $product->price_sell,
    //                 'quantity' => $cartItem->amount,
    //                 'size' => $cartItem->size
    //             ];
    //             $products[] = $productData;
    //             $totalAmount += $product->price_sell * $cartItem->amount;
    //         }
    //     }
    
    //     return response()->json([
    //         'products' => $products,
    //         'totalAmount' => $totalAmount
    //     ]);
    // }
    public function getCartSummaryData(){
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $products = [];
        $totalAmount = 0;

        foreach($cartItems as $cartItem){
            $product = Product::find($cartItem -> product_id);
            if($product){
                $productData = [
                    'id' => $product->id,
                    'name' => $product->name,                                                       
                    'price' => $product->price_sell,
                    'quantity' => $cartItem->amount,
                    'size' => $cartItem->size
                ];
                $products[] = $productData;
                $totalAmount += $product->price_sell * $cartItem->amount;
            }
        }
        return [
            'products' => $products,
            'total' => $totalAmount
        ];
    }
}
