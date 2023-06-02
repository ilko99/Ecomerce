<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\ShipState;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Item successfully added on your cart']);
        }else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ]
            ]);
            
            return response()->json(['success' => 'Item successfully added on your cart']);
        }
    }

    public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    }

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);

        return response()->json(['success' => 'Product removed from cart']);
    }
    
    public function AddToCartFromDetalis(Request $request, $id){
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Item successfully added on your cart']);
        }else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ]
            ]);
            
            return response()->json(['success' => 'Item successfully added on your cart']);
        }
    }

    public function MyCart(){
        $cartTotal = Cart::total();
        return view('frontend.mycart.view_mycart', compact('cartTotal'));
    }

    public function GetCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    }

    public function CartRemove($rowId){
        Cart::remove($rowId);

        return response()->json(['success' => 'Product removed from cart']);
    }

    public function CartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId,$row->qty -1);
        return response()->json('decrement');
    }

    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty +1);
        return response()->json('Increment');
    }

    public function CheckoutCreate(){
        if(Auth::check()){
            if(Cart::total() > 0){
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $division = ShipDivision::orderBy('division_name', 'ASC')->get();
                $district = ShipDistrict::orderBy('disctrict_name', 'ASC')->get();
                $state = ShipState::orderBy('state_name', 'ASC')->get();

                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'division', 'district', 'state'));
            }else{
                $notification = array(
                    'message' => 'You have no products in your cart',
                    'alert-type' => 'error'
                );
    
                return redirect()->to('/')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'You need to login first',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    }

}
