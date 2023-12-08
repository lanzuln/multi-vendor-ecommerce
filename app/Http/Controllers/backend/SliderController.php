<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller {
    public function AllSlider() {
        $sliders = Slider::latest()->get();
        return view('backend.pages.slider.all', compact('sliders'));
    }

    public function AddSlider() {
        return view('backend.pages.slider.create');
    }
    public function StoreSlider(Request $request) {

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(2376, 807)->save('uploads/slider/' . $name_gen);
        $save_url = 'uploads/slider/' . $name_gen;

        Slider::create([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
        ]);

        toastr()->success('Slider Inserted Successfully');

        return redirect()->route('all.slider');

    }

    public function EditSlider($id) {
        $sliders = Slider::findOrFail($id);
        return view('backend.pages.slider.edit', compact('sliders'));
    } // End Method

    public function UpdateSlider(Request $request) {

        $slider_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('slider_image')) {

            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2376, 807)->save('uploads/slider/' . $name_gen);
            $save_url = 'uploads/slider/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
            ]);

            toastr()->success('Slider Updated with image Successfully');

            return redirect()->route('all.slider');

        } else {

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
            ]);

            toastr()->success('Slider Updated without image Successfully');
            return redirect()->route('all.slider');

        }

    }

    public function DeleteSlider($id) {

        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img);

        Slider::findOrFail($id)->delete();

        toastr()->success('Slider Deleted Successfully');

        return redirect()->back();

    }

}
