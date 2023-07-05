<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function PendingOrder(){
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();

        return view('backend.orders.pending_order', compact('orders'));
    }

    public function AdminOrderDetails($order_id){
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('backend.orders.admin_order_details', compact('order', 'orderItem'));
    }

    public function ConfirmedOrder(){
        $orders = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->get();

        return view('backend.orders.confirm_order', compact('orders'));
    }

    public function ProcessingOrder(){
        $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();

        return view('backend.orders.processing_order', compact('orders'));
    }

    public function DeliveredOrder(){
        $orders = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();

        return view('backend.orders.delivered_order', compact('orders'));
    }

    public function PendingToConfirm($order_id){
        Order::findOrFail($order_id)->update(['status' => 'confirmed']);

        $notification = array(
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('confirmed.order')->with($notification); 
    }

    public function ConfirmToProcessing($order_id){
        Order::findOrFail($order_id)->update(['status' => 'processing']);

        $notification = array(
            'message' => 'Order Chenged to Processing',
            'alert-type' => 'success'
        );

        return redirect()->route('processing.order')->with($notification); 
    }

    public function ProcessToDelivered($order_id){

        $product = OrderItem::where('order_id', $order_id)->get();
        foreach($product as $item){
            Product::where('id', $item->product_id)->update([
                'product_quantity' => DB::raw('product_quantity-'.$item->qty)
            ]);
        }

        Order::findOrFail($order_id)->update(['status' => 'delivered']);

        $notification = array(
            'message' => 'Order Chenged to delivered',
            'alert-type' => 'success'
        );

        return redirect()->route('delivered.order')->with($notification);
    }


    
}
