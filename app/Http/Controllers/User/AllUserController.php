<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AllUserController extends Controller
{
    public function UserAccountPage(){
        $user_id = Auth::user()->id;
        $userData = User::findOrFail($user_id);
        return view('frontend.userdashboard.account_details', compact('userData'));
    }

    public function UserChangePassword(){
        return view('frontend.userdashboard.user_change_password');
    }

    public function UserOrderPage(){
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        return view('frontend.userdashboard.user_order_page', compact('orders'));
    }

    public function UserOrderDetails($order_id){
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('frontend.order.order_details', compact('order', 'orderItem'));
    }
}
