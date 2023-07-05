<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Notifications\OrderPending;
use App\Http\Controllers\Controller;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Notification;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){
        Stripe::setApiKey(
            'sk_test_51ND1SuGuyx4xgPPF9gwFw5G04OyTP0hfgl8LacB4PRBmDG2qCeLEOM7F97x7M5QYpOvy0SWwmsCXGcYlq5S4OgIz00DFMhthkW'
            );

            $token = $_POST['stripeToken'];

            $total_amount = round(Cart::total());

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
            'currency' => 'usd',
            'description' => 'Easy multivendor shop',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        // dd($charge);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => $charge->payment_method,
            'payment_method' => 'Stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'ammount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'), 
            'status' => 'pending',
            'created_at' => Carbon::now(),  
        ]);


        // // Mailing
        // $invoice = Order::findOrFail($order_id);

        // $data = [
        //     'invoice_no' => $invoice->invoice_no,
        //     'ammount' => $total_amount,
        //     'email' => $invoice->email,
        //     'name' => $invoice->name,
        // ];

        // Mail::to($request->email)->send(new OrderMail($data));
        // End mailing

        $carts = Cart::content();
        foreach($carts as $cart){

            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' =>Carbon::now(),

            ]);

        } // End Foreach

        Cart::destroy();

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification); 
    }





    public function CashOrder(Request $request){

        $total_amount = round(Cart::total());

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Cash on delivery',
            'payment_method' => 'Cash on delivery',
            'transaction_id' => '',
            'currency' => 'usd',
            'ammount' => $total_amount,


            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'), 
            'status' => 'pending',
            'created_at' => Carbon::now(),  
        ]);

        $carts = Cart::content();
        foreach($carts as $cart){

            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' =>Carbon::now(),

            ]);

        } // End Foreach

        Cart::destroy();

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        $user = User::where('role', 'admin')->get();
        $vendor = OrderItem::with('user')->where('vendor_id', 'id')->get();

        Notification::send($vendor, new OrderPending($request->name));
        Notification::send($user, new OrderComplete($request->name));
        return redirect()->route('dashboard')->with($notification);

    }
}
