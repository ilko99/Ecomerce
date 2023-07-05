<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderVendorController extends Controller
{
    public function VendorOrder(){
        $id = Auth::user()->id;
        $orderItem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id' , 'DESC')->get();

        return view('vendor.orders.pending_orders', compact('orderItem'));
    }

    public function VendorReturnOrder(){
        $id = Auth::user()->id;
        $orderItem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id' , 'DESC')->get();
        return view('vendor.orders.return_orders', compact('orderItem'));
    }

    public function VendorCompleteReturnOrder(){
        $id = Auth::user()->id;
        $orderItem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id' , 'DESC')->get();
        return view('vendor.orders.complete_return_orders', compact('orderItem'));
    }

    public function VendorOrderDetails($id){
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $id)->orderBy('id', 'DESC')->get();

        return view('vendor.orders.vendor_order_details', compact('order', 'orderItem'));
    }
}
