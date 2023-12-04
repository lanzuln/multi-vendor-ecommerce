<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use toastr;

class AdminController extends Controller {
    public function adminLogin() {
        return view('admin.auth.login');

    }
    public function dashboard() {
        return view('admin.index');
    }
    public function adminLogout(Request $request): RedirectResponse {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function adminProfile() {

        $id = Auth::user()->id;
        $admin = User::find($id);
        return view('admin.pages.profile.profile', compact('admin'));
    }
    public function adminProfileUpdate(Request $request) {

        $user = User::find(Auth::user()->id);
        $id = Auth::user()->id;

        if ($request->hasFile('photo')) {
            if ($user && File::exists(public_path($user->photo))) {
                File::delete(public_path($user->photo));
            }
            $file = request()->file('photo');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backendAdmin/uploads/user'), $fileName);
            $filePath = "backendAdmin/uploads/user/{$fileName}";

            User::where("id", $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $filePath,
            ]);
        } else {
            User::where("id", $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }
        toastr()->success('Profile update successfull');
        return redirect()->back();

    }

    public function adminPassword(Request $request) {
        return view('admin.pages.profile.password');
    }

    public function adminPasswordUpdate(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {

            return back()->with("error_msg", "Old Password Doesn't Match!!");
        }

        // Update The new password
        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),

        ]);

        toastr()->success('Password Changed Successfully');
        return back();
    }

    // =========inactive vendor
    public function inactiveVendor() {
        $inactive = User::where('role', 'vendor')
            ->where('status', 'inactive')->latest()->get();
        return view('backend.pages.vendor-manage.inactive', compact('inactive'));
    }

    public function inactiveVendorDetails($id) {
        $inactiveDetails = User::findOrFail($id);
        return view('backend.pages.vendor-manage.inactiveDetails', compact('inactiveDetails'));
    }

    public function activeInactiveVendor(Request $request) {

        $vendor = $request->id;
        User::where('id', $vendor)->update([
            'status' => 'active',
        ]);
        toastr()->success('Vendor activated');
        return redirect('inactive/vendor');
    }

    // ========= active vendor
    public function activeVendor() {
        $active = User::where('role', 'vendor')
            ->where('status', 'active')->latest()->get();
        return view('backend.pages.vendor-manage.active', compact('active'));
    }
    public function activeVendorDetails($id) {
        $activeDetails = User::findOrFail($id);
        return view('backend.pages.vendor-manage.activeDetails', compact('activeDetails'));
    }

    public function inactiveActiveVendor(Request $request) {

        $vendor = $request->id;
        User::where('id', $vendor)->update([
            'status' => 'inactive',
        ]);
        toastr()->success('Vendor Inactivated');
        return redirect('active/vendor');
    }

}
