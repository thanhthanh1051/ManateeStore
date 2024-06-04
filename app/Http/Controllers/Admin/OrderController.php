<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Discount;
use App\Models\OrderDetail;
class OrderController extends Controller
{
    private $order;
    private $orderDetail;
    public function __construct(){
        $this->order = new Order();
        // $this->orderDetail = new OrderDetail();
    }
    public function getPending(){
        $title = 'List of Orders';
        $list = Order::with('orderDetails.product', 'discount', 'user')
                    ->where('status',1)
                    ->get();
        if(!empty($list)) {
            return view('admin.order.statusOrder', compact('title','list'));
        }
        return view('admin.order.statusOrder',compact('title'));
    }
    public function getProcessing(){
        $title = 'List of Orders';
        $list = Order::with('orderDetails.product', 'discount', 'user')
                    ->where('status',2)
                    ->get();
        if(!empty($list)) {
            return view('admin.order.statusOrder', compact('title','list'));
        }
        return view('admin.order.statusOrder',compact('title'));
    }
    public function getOntheway(){
        $title = 'List of Orders';
        $list = Order::with('orderDetails.product', 'discount', 'user')
                    ->where('status',3)
                    ->get();
        if(!empty($list)) {
            return view('admin.order.statusOrder', compact('title','list'));
        }
        return view('admin.order.statusOrder',compact('title'));
    }
    public function getIntransit(){
        $title = 'List of Orders';
        $list = Order::with('orderDetails.product', 'discount', 'user')
                    ->where('status',4)
                    ->get();
        if(!empty($list)) {
            return view('admin.order.statusOrder', compact('title','list'));
        }
        return view('admin.order.statusOrder',compact('title'));
    }
    public function getCancelled(){
        $title = 'List of Orders';
        $list = Order::with('orderDetails.product', 'discount', 'user')
                    ->where('status',5)
                    ->get();
        if(!empty($list)) {
            return view('admin.order.statusOrder', compact('title','list'));
        }
        return view('admin.order.statusOrder',compact('title'));
    }
    public function detailOrder($id) {
        $order = Order::with('orderDetails.product', 'discount', 'user')
                    ->where('id',$id)
                    ->first();
        if(!empty($order)){
            return view('admin.order.detailOrder',compact('order'));
        }
        return view('admin.order.detailOrder');
    }
    // public function getOrderHistory() {
    //     $order = $this->order->getList(auth()->user()->id);
    //     return view('client.order_history',compact('order'));
    // }
    public function getUpdateStatusOrder($id){
        $order = $this->order->getListByIdOrder($id)[0];
        return view('admin.order.update',compact('order'));
    }
    public function postUpdateStatusOrder(Request $request, $id) {
        $this->order->updateStatusOrder($request->code,$request->status);
        return redirect()->route('admin.orders.getList')->with('msg','Cập nhật đơn hàng thành công');
    }
}
