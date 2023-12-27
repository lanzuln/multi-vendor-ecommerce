<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

     public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
