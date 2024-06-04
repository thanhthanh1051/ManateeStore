<?php

namespace App\Http\Controllers\Client\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Rank;
use Illuminate\Support\Facades\Auth;
class cartController extends Controller
{
    private $orderdetail;
    public function getCart()
    {
        if (Auth::check()) {
        // Lấy tất cả các mục giỏ hàng của người dùng
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        
        // Tạo một mảng để lưu trữ thông tin sản phẩm
        $products = [];

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
    
    public function checkDiscount(Request $request){
        $code = $request->voucher;
        $discount = Discount::where('code',$code)->first();
        if($discount){
            $rankDiscount = $discount->rank_id;
            $rankCus = Auth()->user()->rank_id;
            if($rankDiscount == $rankCus){
                $count_discount = $discount->count();
                if($count_discount>0){
                    return redirect()->back()->with(['discount'=>$discount]);
                    }else{
                        return redirect()->back()->with(['discount'=>$discount]);
                }
            }else{
                return redirect()->back();
            }
        }else{
            return response()->json(['success' => false, 'message' => 'Invalid discount code']);
       }
    }
    
    // public function checkout(Request $request){
    //     $check = Auth::user()->phone && Auth::user()->address;
    //     if(!($check)){
    //         return response()->json([
    //             "status" => "error",
    //             "des" => "You dont have fill out your information to checkout"
    //         ]);
    //     }else{
    //         $cartItems = Cart::where('user_id', Auth::user()->id)->get();

    //         $order = new Order();
    //         $order->user_id = Auth::user()->id;
    //         $order->save();
    //         $totalAmount = 0;
    
    //         foreach($cartItems as $cartItem){
    //             $product = Product::where('id', $cartItem->product_id)->first();     
    //             $orderDetail = new OrderDetail();
    //             $orderDetail->order_id = $order->id;
    //             $orderDetail->product_id = $cartItem->product_id;
    //             $orderDetail->amount = $cartItem->amount;
    //             $orderDetail->price = $product->price_sell;
    //             $orderDetail->save();
    
    //             $totalAmount += $cartItem->amount * $product->price_sell;
    //         }
    //         $order->total = $totalAmount;
    //         $order->save();
    
    //         Cart::where('user_id', Auth::user()->id)->delete();
    //         return response([
    //             "status" => "success"
    //         ]);
    //     }
    // }

    public function checkout(Request $request){
        $userAu = Auth::user()->id;
        $user = User::find($userAu);
        $check = $user->phone && $user->address;

        if(!($check)){
            return response()->json([
                "status" => "error",
                "description" => "You need to fill information to checkout"
            ]);
        } else {
            $cartItems = Cart::where('user_id', $user->id)->get();

            if($cartItems->isEmpty()){
                return response()->json([
                    "status" => "error",
                    "description" => "Your cart is empty"
                ]);
            }

            $order = new Order();
            $order->user_id = $user->id;
            $order->phone = $user->phone;
            $order->address = $user->address;
            $order->total = 0;
            $discountAmount = 0;

            if(session('discount')){
                $discount = session('discount');
                $order->discount_id= $discount->id;
                $discountAmount = $discount->price;
            }
            $order->save();

            $totalAmount = 0;

            foreach($cartItems as $cartItem){
                $product = Product::find($cartItem->product_id);

                if(!$product){
                    return response()->json([
                        "status" => "error",
                        "description" => "One or more in your cart do not exist"
                    ]);
                }

                $product->amount -= $cartItem->amount;
                $product->save();

                $this->orderdetail = new OrderDetail();
                $data = [
                    "order_id" => $order->id,
                    "product_id" => $cartItem->product_id,
                    "amount" => $cartItem->amount,
                    "size" => $cartItem->size,
                    "price" => $product->price_sell
                ];
                $this->orderdetail->add($data);
                // $orderDetail = new OrderDetail();
                // $orderDetail->order_id = $order->id;
                // $orderDetail->product_id = $cartItem->product_id;
                // $orderDetail->amount = $cartItem->amount;
                // $orderDetail->price = $product->price_sell;
                // $orderDetail->save();

                $totalAmount += $cartItem->amount * $product->price_sell;
            }
            $order->total = $totalAmount - $discountAmount;
            $order->status = 1;
            $order->save();

            session()->forget('discount');
            Cart::where('user_id', $user->id)->delete();

            return response()->json([
                "status" => "success",
                "description" => "Checkout successful"
            ]);
        }
    }

    public function info(){
        return view('client.cart.info');
    }
    public function postInfo(Request $request){
        $request->validate([
            "phone" => 'required| string | min:10 | max:10',
            "address" => 'required'
        ]);
        $user = User::where('id',Auth::user()->id)->first();
        if($user){
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->save();
        }
        return redirect()->route('getCart');
    }
}
