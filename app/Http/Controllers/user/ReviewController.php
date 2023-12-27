<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller {
    public function StoreReview(Request $request) {

        $product = $request->product_id;
        $vendor = $request->hvendor_id;

        $request->validate([
            'comment' => 'required',
        ]);

        Review::insert([

            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id' => $vendor,
            'created_at' => Carbon::now(),

        ]);

        toastr()->success('Review Will Approve By Admin');

        return redirect()->back();

    } // End Method

    public function PendingReview() {

        $review = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('backend.pages.review.pending_review', compact('review'));

    } // End Method

    public function ReviewApprove($id) {

        Review::where('id', $id)->update(['status' => 1]);

        toastr()->success('Review Approved Successfully');
        return redirect()->back();

    } // End Method

    public function PublishReview() {

        $review = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('backend.pages.review.publish_review', compact('review'));

    } // End Method

    public function ReviewDelete($id) {

        Review::findOrFail($id)->delete();


        toastr()->success('Review Deleted Successfully');

        return redirect()->back();

    } // End Method

    public function VendorAllReview() {

        $id = Auth::user()->id;

        $review = Review::where('vendor_id', $id)->where('status', 1)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.review.approve_review', compact('review'));

    } // End Method

}
