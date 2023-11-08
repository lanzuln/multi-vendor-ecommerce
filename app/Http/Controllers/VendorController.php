<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class VendorController extends Controller
{

    public function dashboard() {
        return view('vendor.index');
    }
    public function vendorLogin() {
        return view('vendor.auth.login');

    }
    public function vendorLogout(Request $request): RedirectResponse {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

    public function vendorProfile() {

        $id = Auth::user()->id;
        $vendor = User::find($id);
        return view('vendor.pages.profile.profile', compact('vendor'));
    }
    public function vendorProfileUpdate(Request $request) {

        $user = User::find(Auth::user()->id);
        $id = Auth::user()->id;

        if ($request->hasFile('photo')) {
            if ($user && File::exists(public_path($user->photo))) {
                File::delete(public_path($user->photo));
            }
            $file = request()->file('photo');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backendVendor/uploads/user'), $fileName);
            $filePath = "backendVendor/uploads/user/{$fileName}";

            User::where("id", $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'join_date' => $request->join_date,
                'short_desc' => $request->short_desc,
                'photo' => $filePath,
            ]);
        } else {
            User::where("id", $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'join_date' => $request->join_date,
                'short_desc' => $request->short_desc,
            ]);
        }
        toastr()->success('Profile update successfull');
        return redirect()->back();

    }

    public function vendorPassword(Request $request) {
        return view('vendor.pages.profile.password');
    }

    public function vendorPasswordUpdate(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {

            return back()->with("error_msg", "Old Password Doesn't Match!!");
        }

        // Update The new password
        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        toastr()->success('Password Changed Successfully');
        return back();
    }

    }
