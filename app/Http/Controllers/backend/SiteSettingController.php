<?php

namespace App\Http\Controllers\backend;

use App\Models\Seo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller {
    public function SiteSetting() {

        $setting = SiteSetting::find(1);
        return view('backend.pages.setting.setting_update', compact('setting'));

    } // End Method

    public function SiteSettingUpdate(Request $request) {

        $setting_id = $request->id;

        if ($request->file('logo')) {

            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(180, 56)->save('uploads/logo/' . $name_gen);
            $save_url = 'uploads/logo/' . $name_gen;

            SiteSetting::findOrFail($setting_id)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
                'logo' => $save_url,
            ]);

            toastr()->success('Site Setting Updated with image Successfully');

            return redirect()->back();

        } else {

            SiteSetting::findOrFail($setting_id)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
            ]);

            toastr()->success('Site Setting Updated without image Successfully');

            return redirect()->back();

        } // end else

    } // End Method

    //////////// Seo Setting /////////////

    public function SeoSetting() {

        $seo = Seo::find(1);
        return view('backend.pages.seo.seo_update', compact('seo'));

    } // End Method

    public function SeoSettingUpdate(Request $request) {
        $seo_id = $request->id;

        Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);


        toastr()->success('Seo Setting Updated Successfully');

        return redirect()->back();

    } // End Method
}
