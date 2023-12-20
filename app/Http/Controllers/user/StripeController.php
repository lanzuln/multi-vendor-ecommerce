<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){

        \Stripe\Stripe::setApiKey('sk_test_51ILVuBFw2tOvYBP8R1KqaXXPA5VCrnOAIpN7asNTtDDt38H6LO9YvujalrPfghF89wH8D1LBPM5SstduqaK7yJEC005UqOAetw');


        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
          'amount' => 999*100,
          'currency' => 'usd',
          'description' => 'Easy Mulit Vendor Shop',
          'source' => $token,
          'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);
}
}
