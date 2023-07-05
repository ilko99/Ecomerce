<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VendorRegister;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Notification;

class VendorController extends Controller
{
    public function VendorDashboard(){
        $id = Auth::user()->id;
        // $currentDate = Carbon::now();
        // $date = $currentDate->format('Y-m-d');
        // $month = $currentDate->format('m');

        $date = date('d F Y');
        
        $today = OrderItem::whereHas('order', function ($query) use ($id, $date) {
            $query->where('vendor_id', $id)->where('order_date', $date);
        })->sum('price');

        $orderItem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id' , 'DESC')->get();
       

        return view('vendor.index', compact('orderItem', 'today'));
    }

    public function VendorLogin(){
        return view('vendor.vendor_login');
    }

    public function VendorDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

    public function VendorProfile(){
        $id = Auth::user()->id;
        $vendorData = User::findOrFail($id);
        return view('vendor.vendor_profile_view', compact('vendorData'));
    }

    public function VendorProfileStore(Request $request){
        $id = Auth::user()->id;

        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/'.$data->photo)); // Tova se pravi nakraq sled vsicho ostanalo v metoda
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);        
    }

    public function VendorChangePassword(){
        return view('vendor.vendor_change_password');
    }

    public function VendorUpdatePassword(Request $request){
        //validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        //Match with old password checkup
        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with("error", "Old password doesnt match");
        }

        //Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("status", "Password Changed Successfully");
    }

    public function BecomeVendor(){
        return view('auth.become_vendor');
    }

    public function VendorRegister(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor Registered Successfully',
            'alert-type' => 'success'
        );
        $vuser = User::where('role', 'admin')->get();
        Notification::send($vuser, new VendorRegister($request));
        
        return redirect()->route('vendor.login')->with($notification);    

    }
    
    
}
