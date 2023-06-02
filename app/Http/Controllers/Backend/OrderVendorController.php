<?php

namespace App\Http\Controllers\Backend;

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
}
