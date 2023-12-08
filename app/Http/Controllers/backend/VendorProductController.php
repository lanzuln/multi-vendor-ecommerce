<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ProductMultiImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class VendorProductController extends Controller
{
    public function GetVendorSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('name','ASC')->get();
            return json_encode($subcat);

    }
    public function VendorAllProduct(){

        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('vendor.backend.product.all',compact('products'));
    } // End Method

    public function VendorCreateProduct() {
        $brand = Brand::orderBy('brand_name')->select('id', 'brand_name', 'brand_slug')->get();
        $category = Category::orderBy('category_name')->select('id', 'category_name', 'category_slug')->get();
        return view('vendor.backend.product.create', compact('brand', 'category',));
    }

    public function VendorStoreProduct(Request $request) {

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('uploads/products/thambnail/' . $name_gen);
        $save_url = 'uploads/products/thambnail/' . $name_gen;

        // dd($request->all());
        $product_id = Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thambnail' => $save_url,
            'vendor_id' => Auth::user()->id,
            'status' => 1,

        ]);

        /// Multiple Image Upload From her //////

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('uploads/products/multi-image/' . $make_name);
            $uploadPath = 'uploads/products/multi-image/' . $make_name;

            ProductMultiImages::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,

            ]);
        } // end foreach

        /// End Multiple Image Upload From her //////

        toastr()->success('Product created successfully');

        return redirect()->route('vendor.all.product');

    }
    public function VendorEditProduct($id) {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        $multiImgs = ProductMultiImages::where('product_id', $id)->get();
        return view('vendor.backend.product.edit', compact('brands', 'categories', 'products', 'subcategory', 'multiImgs'));
    } // End Method

    public function VendorUpdateProduct(Request $request) {

        $product_id = $request->id;

        Product::findOrFail($product_id)->update([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,

        ]);

        toastr()->success('Product Updated Without Image Successfully');
        return redirect()->route('vendor.all.product');

    }

    public function UpdateProductThambnail(Request $request) {

        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('uploads/products/thambnail/' . $name_gen);
        $save_url = 'uploads/products/thambnail/' . $name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Product::findOrFail($pro_id)->update([

            'product_thambnail' => $save_url,
        ]);

        toastr()->success('Product image updated');

        return redirect()->back();

    } // End Method

    public function UpdateProductMultiimage(Request $request) {

        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {

            $imgDel = ProductMultiImages::findOrFail($id);

            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('uploads/products/multi-image/' . $make_name);
            $uploadPath = 'uploads/products/multi-image/' . $make_name;

            ProductMultiImages::where('id', $id)->update([
                'photo_name' => $uploadPath,

            ]);
        } // end foreach

        toastr()->success('Product Multi Image Updated Successfully');

        return redirect()->back();

    } // End Method
    public function MulitImageDelelte($id){
        $oldImg = ProductMultiImages::findOrFail($id);
        unlink($oldImg->photo_name);

        ProductMultiImages::findOrFail($id)->delete();

        toastr()->success('Multi image delete successdull');

        return redirect()->back();

    }// End Method

    public function productInactive($id){
        Product::where('id',$id)->update([
            'status'=>0
        ]);
        toastr()->success('Inactive product');

        return redirect()->back();
    }

    public function productActive($id){
        Product::where('id',$id)->update([
            'status'=>1
        ]);
        toastr()->success('Active product');

        return redirect()->back();
    }

    public function ProductDelete($id){

        // Retrieve the product model instance
        $product = Product::find($id);

        // Check if the product exists before proceeding
        if ($product) {
            // Delete the product thumbnail file
            unlink($product->product_thambnail);

            // Delete the product record
            $product->delete();

            // Delete associated multi-images
            $images = ProductMultiImages::where('product_id', $id)->get();
            foreach ($images as $image) {
                unlink($image->photo_name);
                $image->delete();
            }

            toastr()->success('Product Deleted Successfully');
        } else {
            toastr()->error('Product not found');
        }

        return redirect()->back();
    }
}
