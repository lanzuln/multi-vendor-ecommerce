<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function allBrand(){
        $brand= Brand::latest()->get();
        return view("backend.pages.brand.all",compact("brand"));

    }
    public function createBrand(){
        return view("backend.pages.brand.create");

    }
    public function storeBrand(Request $request){

        $image = $request->file('brand_image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(300, 300)->save(public_path('frontend/uploads/brand/' . $image_name));
        $image_url = 'frontend/uploads/brand/' . $image_name;

         Brand::create([
            'brand_name'=>$request->brand_name,
            'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
            'brand_image'=>$image_url,
        ]);

        toastr()->success('Brand created');
        return redirect('/all/brand');
    }

    public function editBrand($id){
        $brand= Brand::find($id);
        return view('backend.pages.brand.edit',compact('brand'));
    }
    public function updateBrand(Request $request){
        $brand_Id= $request->brand_id;
        $old_image= $request->old_image;


               if ($request->hasFile('brand_image')) {
                if(file_exists($old_image)){
                    unlink($old_image);
                }
                $image = $request->file('brand_image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

                Image::make($image)->resize(300, 300)->save(public_path('frontend/uploads/brand/' . $image_name));
                $image_url = 'frontend/uploads/brand/' . $image_name;

                Brand::where('id',$brand_Id)->update([
                    'brand_name'=>$request->brand_name,
                    'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
                    'brand_image'=>$image_url,
                ]);

            }else{
                Brand::where('id',$brand_Id)->update([
                    'brand_name'=>$request->brand_name,
                    'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
                ]);
            }
            toastr()->success('Brand updated');
            return redirect('/all/brand');
    }

    public function deleteBrand($id){
        $brand = Brand::find($id);
        $old_image= $brand->brand_image;
        unlink($old_image);
        Brand::where('id',$id)->delete();

        toastr()->success('Brand deleted');
        return back();
    }
}
