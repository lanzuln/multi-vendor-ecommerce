<?php

namespace App\Http\Controllers\frontend;

use App\Models\Banner;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductMultiImages;
use App\Http\Controllers\Controller;

class homecontroller extends Controller
{
    public function index(){
        $slider = Slider::latest()->get();
        $banner = Banner::latest()->limit(3)->get();
        $product = Product::where('status',1)->latest()
        ->select('id','category_id','product_name','product_slug','selling_price','discount_price','product_thambnail','vendor_id',)
        ->limit(10)->get();

        $skip_category_0 = Category::whereId(8)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->limit(5)->get();


        $food_cat = Category::whereId(9)->first();
        $food_cat_product = Product::where('status',1)->where('category_id',$food_cat->id)->orderBy('id','DESC')->limit(5)->get();

        $fashion_cat = Category::whereId(10)->first();
        $fashion_cat_product = Product::where('status',1)->where('category_id',$fashion_cat->id)->orderBy('id','DESC')->limit(5)->get();


        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();
        $recent_product = Product::where('status',1)->latest('id')->limit(3)->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.index',compact(
            'slider',
            'banner',
            'product',
            'skip_category_0',
            'skip_product_0',
            'food_cat',
            'food_cat_product',
            'fashion_cat',
            'fashion_cat_product',
            'hot_deals',
            'special_offer',
            'recent_product',
            'special_deals'

        ));
    }

    public function product_detailed($id, $slug){

        $single_product = Product::findOrFail($id);

        $color = $single_product->product_color;
        $product_color = explode(',', $color);

        $size = $single_product->product_size;
        $product_size = explode(',', $size);
        $multiImage = ProductMultiImages::where('product_id',$id)->get();


        $cat_id = $single_product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();
        return view('frontend.layout.product.single_product',compact('single_product','product_color','product_size','multiImage','relatedProduct'));
    }
}
