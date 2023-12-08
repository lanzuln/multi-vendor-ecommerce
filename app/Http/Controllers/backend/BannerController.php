<?php

namespace App\Http\Controllers\backend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BannerController extends Controller {
    public function AllBanner() {
        $banner = Banner::latest()->get();
        return view('backend.pages.banner.all', compact('banner'));
    }

    public function AddBanner() {
        return view('backend.pages.banner.create');
    }
    public function StoreBanner(Request $request) {

        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(768, 450)->save('uploads/banner/' . $name_gen);
        $save_url = 'uploads/banner/' . $name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
        ]);


        toastr()->success('Banner Inserted Successfully');

        return redirect()->route('all.banner');

    }


    public function EditBanner($id){
        $banner = Banner::findOrFail($id);
        return view('backend.pages.banner.edit',compact('banner'));
    }// End Method


    public function UpdateBanner(Request $request){

        $banner_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('banner_image')) {

        $image = $request->file('banner_image');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('uploads/banner/'.$name_gen);
        $save_url = 'uploads/banner/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Banner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
        ]);


        toastr()->success('Banner Updated with image Successfully');
        return redirect()->route('all.banner');

        } else {

            Banner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
        ]);

        toastr()->success('Banner Updated without image Successfully');

        return redirect()->route('all.banner');

        } // end else

    }// End Method




    public function DeleteBanner($id){

        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        unlink($img );

        Banner::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

}
