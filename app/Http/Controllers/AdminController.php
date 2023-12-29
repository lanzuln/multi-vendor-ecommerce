<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorApproveNotification;

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
        $vuser = User::where('role','vendor')->get();
        Notification::send($vuser, new VendorApproveNotification($request));
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

    ///////////// Admin All Method //////////////

    public function AllAdmin() {
        $alladminuser = User::where('role', 'admin')->latest()->get();
        // dd($alladminuser);
        return view('backend.pages.admin.all_admin', compact('alladminuser'));
    } // End Mehtod

    public function AddAdmin() {
        $roles = Role::all();
        return view('backend.pages.admin.add_admin', compact('roles'));
    } // End Mehtod

    public function AdminUserStore(Request $request) {
        try {

// dd($request->all());
            $user = new User();
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = Hash::make($request->password);
            $user->role = 'admin';
            $user->status = 'active';
            $user->save();

            if ($request->roles) {
                $user->assignRole($request->roles);
            }

            toastr()->success('New Admin User Inserted Successfully');

            return redirect()->route('all.admin');

        } catch (Exception $e) {

            toastr()->error('somrthig went wrong');

            return redirect()->back();
        }

    } // End Mehtod

    public function EditAdminRole($id) {

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.pages.admin.edit_admin', compact('user', 'roles'));
    } // End Mehtod

    public function AdminUserUpdate(Request $request, $id) {

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        toastr()->success('New Admin User Updated Successfully');
        return redirect()->route('all.admin');

    } // End Mehtod

    public function DeleteAdminRole($id) {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        toastr()->success('Admin User Deleted Successfully');

        return redirect()->back();

    } // End Mehtod

}
