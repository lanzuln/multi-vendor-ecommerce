<?php

namespace App\Http\Controllers\user;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $product_id){

        if (Auth::check()) {
      $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if (!$exists) {
               Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),

               ]);
               return response()->json(['success' => 'Successfully Added On Your Wishlist' ]);
            } else{
                return response()->json(['error' => 'This Product Has Already on Your Wishlist' ]);

            }

        }else{
            return response()->json(['error' => 'At First Login Your Account' ]);
        }

    } // End Method


    public function AllWishlist(){

        return view('frontend.pages.wishlist.all_wishlist');

    }//

    public function GetWishlistProduct(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::user()->id)->latest()->get();
        $wishQty= Wishlist::where('user_id',Auth::user()->id)->count();

        // $wishQty = wishlist::count();

        return response()->json(['wishlist'=> $wishlist, 'wishQty' => $wishQty]);

    }// End Method

    public function WishlistRemove($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
     return response()->json(['success' => 'Successfully Product Remove' ]);
    }// End Method

}
