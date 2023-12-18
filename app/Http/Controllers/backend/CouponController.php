<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller {
    public function AllCoupon() {
        $coupon = Coupon::latest()->get();
        return view('backend.pages.coupon.all', compact('coupon'));
    } //

    public function AddCoupon() {
        return view('backend.pages.coupon.create');
    } //

    public function StoreCoupon(Request $request) {

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),

        ]);
        toastr()->success('Coupon created successfull');
        return redirect()->route('all.coupon');
    } // End Method

    public function EditCoupon($id) {

        $coupon = Coupon::findOrFail($id);
        return view('backend.pages.coupon.edit', compact('coupon'));

    } // End Method

    public function UpdateCoupon(Request $request) {

        $coupon_id = $request->id;

        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        toastr()->success('Coupon update successfull');
        return redirect()->route('all.coupon');

    } // End Method

    public function DeleteCoupon($id) {

        Coupon::findOrFail($id)->delete();
        toastr()->success('Coupon delete successfull');
        return redirect()->back();

    } // End Method
}
