<?php

namespace App\Http\Controllers\Client\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
class accountController extends Controller
{
    private $order;
    private $order_detail;

    public function __construct(){
        $this->order = new Order;
        $this->order_detail = new OrderDetail;
    }

    public function getAccount(){
        return view('client.profile.info_profile');
    }
    public function postAccount(Request $req, $id=0){
        $id = Auth::user()->id;
        $req ->validate([
            'name' => 'required | max:255 | string',
            'email' => 'required | email',
            'dob' => 'before:today'
        ]);
        if(!empty($id)){
            $user = User::find($id);
            if(!empty($user)){
                $user->name = $req->name;
                $user->email = $req->email;
                $user->phone = $req->phone;
                $user->dob = $req->dob;
                $user->gender = $req->gender;
                $user->address = $req->address;
                $check = $user->save();
                if($check){
                    return redirect()->route('getAccount')->with('success', 'Your information has been changed.');
                }
            }
        }
        return redirect()->route('getAccount')->with('error', "Can't find user");
    }
    public function getOrder(){
        return view('client.profile.order');
    }
    // public function getPending(){
    //     $order = Order::where('user_id', Auth::user()->id)
    //                         ->where('status', 1)
    //                         ->get();
    //     if(!empty($order)){
    //         foreach($order as $item){
    //             $product = OrderDetail::with('product')
    //                                         ->where('order_id', $item->id)
    //                                         ->get();
    //             return view('client.profile.pending', compact('order', 'product'));
    //         }
    //     }
    //     return view('client.profile.pending');
    // }

    public function getPending(){
        $orders = Order::with('orderDetails.product', 'discount')
                    ->where('user_id', Auth::user()->id)
                    ->where('status',1)
                    ->get();
        return view('client.profile.statusOrder', compact('orders'));
    }
    public function getProcessing(){
        $orders = Order::with('orderDetails.product', 'discount')
                    ->where('user_id', Auth::user()->id)
                    ->where('status',2)
                    ->get();
        return view('client.profile.statusOrder', compact('orders'));
    }
    public function getOntheway(){
        $orders = Order::with('orderDetails.product', 'discount')
                    ->where('user_id', Auth::user()->id)
                    ->where('status',3)
                    ->get();
        return view('client.profile.statusOrder', compact('orders'));
    }
    public function getIntransit(){
        $orders = Order::with('orderDetails.product', 'discount')
                    ->where('user_id', Auth::user()->id)
                    ->where('status',4)
                    ->get();
        return view('client.profile.statusOrder', compact('orders'));
    }
    public function getCancelled(){
        $orders = Order::with('orderDetails.product', 'discount')
                    ->where('user_id', Auth::user()->id)
                    ->where('status',5)
                    ->get();
        return view('client.profile.statusOrder', compact('orders'));
    }
    public function cancel($id){
        $order = Order::where('id',$id)
                      ->update(['status' => 5]);

        return back();
    }
}
