<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function PendingOrder(){
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();

        return view('backend.orders.pending_order', compact('orders'));
    }
}
