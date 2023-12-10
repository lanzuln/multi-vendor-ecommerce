<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendVendor extends Controller
{
    public function vendorList(){

     $vendor = User::where('status',1)->latest()->get();

        return view('frontend.vendor.vendor', compact('vendor'));
    }
    public function vendor_detailed($id){
        $vendor = User::findOrFail($id);
        $vproduct = Product::where('vendor_id',$id)->where('status',1)->get();

        return view('frontend.vendor.single_vendor', compact('vendor','vproduct'));
    }
}
