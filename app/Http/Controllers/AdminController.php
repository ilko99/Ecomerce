<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VendorApproved;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function AdminDashboard(){
        $date = date('d F Y');       
        $yesterday = Carbon::yesterday()->format('d F Y');
        $todayAmount = Order::where('order_date', $date)->sum('ammount');

        $yesterdayAmount = Order::where('order_date', $yesterday)->sum('ammount');
        
        if ($yesterdayAmount != 0) {
            $percentDiff = (($todayAmount - $yesterdayAmount) / $yesterdayAmount) * 100;
            $formattedPercentage = number_format($percentDiff, 2);
        } else {
            // Handle the case where yesterday's amount is zero.
            $formattedPercentage = 'N/A';
        }


        $month = date('F');
        $thisMonthAmount = Order::where('order_month', $month)->sum('ammount');
        $lastMonth = Carbon::now()->subMonths(1)->format('d F Y');
        $lastMonthAmount = Order::where('order_month', $lastMonth)->sum('ammount');

        if ($lastMonthAmount != 0) {
            $percentDiffMonth = (($thisMonthAmount - $lastMonthAmount) / $lastMonthAmount) * 100;
            $formattedPercentageMonth = number_format($percentDiffMonth, 2);
        } else {
            // Handle the case where yesterday's amount is zero.
            $formattedPercentageMonth = 'N/A';
        }

        $year = date('Y');
        $thisYear = Order::where('order_year', $year)->sum('ammount');

        $pending = Order::where('status', 'pending')->get();

        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->limit(10)->get();
        return view('admin.index', compact('todayAmount', 'yesterdayAmount', 'thisMonthAmount', 'lastMonthAmount', 'thisYear', 'pending', 'orders', 'formattedPercentage', 'formattedPercentageMonth'));
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::findOrFail($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;

        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo)); // Tova se pravi nakraq sled vsicho ostanalo v metoda
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);        
    }

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request){
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

    public function InactiveVendor(){
        $inactiveVendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inactiveVendor'));
    }

    public function ActiveVendor(){
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.active_vendor', compact('activeVendor'));
    }

    public function InactiveVendorDetails($id){
        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details', compact('inactiveVendorDetails'));
    }

    public function ActiveVendorApprove(Request $request){
        $vendor_id = $request->id;

        $user = User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Vendor Activated Successfully',
            'alert-type' => 'success'
        );

        $vuser = User::where('role', 'vendor')->get();
        Notification::send($vuser, new VendorApproved($request));

        return redirect()->route('active.vendor')->with($notification);
    }

    public function ActiveVendorDetails($id){
        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));
    }
   
    public function InactiveVendorApprove(Request $request){
        $vendor_id = $request->id;

        $user = User::findOrFail($vendor_id)->update([
            'status' => 'inactive'
        ]);

        $notification = array(
            'message' => 'Vendor Inactivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.vendor')->with($notification);
    }

    /////// ADMIN ALL METHODS
    
    public function AllAdmin(){
        $alladmin_user = User::where('role', 'admin')->latest()->get();
        return view('backend.admin.all_admin', compact('alladmin_user'));
    }

    public function AddAdmin(){
        $roles = Role::all();
        return view('backend.admin.add_admin', compact('roles'));
    }

    public function AdminUserStore(Request $request){
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if($request->roles){
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function EditAdminRole($id){

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.admin.edit_admin',compact('user','roles'));
    }

    public function AdminUserUpdate(Request $request,$id){


        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address; 
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }

    public function DeleteAdminRole($id){
        $user = User::findOrFail($id);

        if(!is_null($user)){
            $user->delete();
        }

        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


}
