<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveUserController extends Controller
{
    public function AllUser(){
        $users = User::where('role','user')->latest()->get();
        return view('backend.pages.user.user_all_data',compact('users'));

    } // End Mehtod

    public function AllVendor(){
        $vendors = User::where('role','vendor')->latest()->get();
        return view('backend.pages.user.vendor_all_data',compact('vendors'));

    } // End Mehtod
}
