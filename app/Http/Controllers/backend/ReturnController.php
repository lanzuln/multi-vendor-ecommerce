<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{
    public function ReturnRequest(){

        $orders = Order::where('return_order',1)->orderBy('id','DESC')->get();
        return view('backend.pages.return_order.return_request',compact('orders'));

    } // End Method


    public function ReturnRequestApproved($order_id){

        Order::where('id',$order_id)->update(['return_order' => 2]);

        toastr()->success('Return Order Successfully');

        return redirect()->back();

    } // End Method


     public function CompleteReturnRequest(){

        $orders = Order::where('return_order',2)->orderBy('id','DESC')->get();
        return view('backend.pages.return_order.complete_return_request',compact('orders'));

    } // End Method

}
