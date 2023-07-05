<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveUserController extends Controller
{
    public function AllUser(){
        $users = User::where('role', 'user')->latest()->get();
        return view('backend.user.user_all_data', compact('users'));
    }

    public function AllVendor(){
        $users = User::where('role', 'vendor')->latest()->get();
        return view('backend.user.vendor_all_data', compact('users'));
    }
}
