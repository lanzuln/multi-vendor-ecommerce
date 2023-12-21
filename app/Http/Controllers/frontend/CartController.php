<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller {

    public function MyCart() {

        return view('frontend.pages.cart.cart_page');

    } // End Method
    public function AddToCart(Request $request, $id) {

        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL) {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);

        } else {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);

        }

    } // End Method

    public function AddMiniCart() {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::subtotal();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,

        ));
    } // End Method

    public function RemoveMiniCart($rowId) {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);

    } // End Method
    public function AddToCartDetails(Request $request, $id) {

        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL) {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);

        } else {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);

        }

    } // End Method

    // single cart page
    public function GetCartProduct() {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,

        ));

    } // End Method

    public function CartRemove($rowId) {
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);

    } // End Method

    public function CartDecrement($rowId) {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::subtotalFloat() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::subtotalFloat() - (Cart::subtotalFloat() * $coupon->coupon_discount / 100)),
            ]);
        }

        return response()->json('Decrement');

    } // End Method

    public function CartIncrement($rowId) {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::subtotalFloat() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::subtotalFloat() - (Cart::subtotalFloat() * $coupon->coupon_discount / 100)),
            ]);
        }

        return response()->json('Increment');

    } // End Method

    public function CouponApply(Request $request) {
        // $request->validate([
        //     'coupon' => 'required',
        // ]);

        $cartItemCount = Cart::content()->count();
        if ($cartItemCount == 0) {
            return response()->json(['error' => 'No item In the Cart']);
        }

        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::subtotalFloat() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::subtotalFloat() - (Cart::subtotalFloat() * $coupon->coupon_discount / 100)),
            ]);

            return response()->json([
                'validity' => true,
                'success' => 'Coupon Applied Successfully',

            ]);

        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }

    } // End Method

    public function CouponCalculation() {

        if (Session::has('coupon')) {
            $cartItemCount = Cart::content()->count();

            return response()->json(array(
                'subtotal' => Cart::subtotalFloat(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
                'cartItemCount' => $cartItemCount,
            ));
        } else {

            $cartItemCount = Cart::content()->count();

            return response()->json(array(
                'total' => Cart::subtotalFloat(),
                'cartItemCount' => $cartItemCount,
            ));

        }
    } // End Method

    public function CouponRemove() {

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);

    } // End Method

    public function CheckoutCreate() {

        if (Auth::check()) {

            if (Cart::total() > 0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::subtotal();
                $divisions = ShipDivision::orderBy('division_name','ASC')->get();

                return view('frontend.pages.checkout.checkout',compact('carts','cartQty','cartTotal','divisions'));

            } else {


                toastr()->error('Shopping At list One Product');

                return redirect()->to('/');
            }

        } else {


            toastr()->error('You Need to Login First');

            return redirect()->route('login');
        }

    } // End Method
}
