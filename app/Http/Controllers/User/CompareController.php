<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Compare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function AddToCompare(Request $request, $product_id){
        if(Auth::check()){
            $exists = Compare::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if(!$exists){
                Compare::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Item successfully added on your compare']);
            }else{
                return response()->json(['error' => 'This product is already on your compare']);
            }
        }else{
            return response()->json(['error' => 'Login to your account']);
        }
    }

    public function AllCompare(){
        return view('frontend.compare.view_compare');
    }

    public function GetCompareProduct(){
        $compare = Compare::with('product')->where('user_id', Auth::id())->latest()->get();

        // $wishQty = Compare::count();
        return response()->json($compare);

    }

    public function CompareRemove($id){
        Compare::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Product Remove' ]);
    }

}
