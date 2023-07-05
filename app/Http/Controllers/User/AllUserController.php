<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function UserOrderInvoice($order_id){
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }   

    public function ReturnOrder(Request $request, $order_id){
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reson,
            'return_order' => 1,
        ]);

        $notification = array(
            'message' => 'Return request sent successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('user.order.page')->with($notification);
    }

    public function ReturnOrderPage()
    {
        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();

        return view('frontend.order.return_order_view', compact('orders'));
    }

    public function UserTrackOrder(){
        return view('frontend.userdashboard.user_track_order');
    }

    public function OrderTracking(Request $request){
        $invoice = $request->code;
        $track = Order::where('invoice_no', $invoice)->first();

        if($track){
            return view('frontend.tracking.track_order', compact('track'));
        } else{
            $notification = array(
                'message' => 'Invoice code is invalid',
                'alert-type' => 'error',
            );
            
            return redirect()->back()->with($notification);
        }
    }
}
