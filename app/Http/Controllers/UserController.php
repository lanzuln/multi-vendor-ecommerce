<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller {
    public function dashboard() {
        $id = auth()->user()->id;
        $user= User::find($id);

        return view("dashboard", compact('user'));
    }
    public function userLogout(Request $request): RedirectResponse {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function profileUpdate(Request $request) {

        $user = User::find(Auth::user()->id);
        $id = Auth::user()->id;

        if ($request->hasFile('photo')) {
            if ($user && File::exists(public_path($user->photo))) {
                File::delete(public_path($user->photo));
            }
            $file = request()->file('photo');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('frontend/uploads/user'), $fileName);
            $filePath = "frontend/uploads/user/{$fileName}";

            User::where("id", $id)->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $filePath,
            ]);
        } else {
            User::where("id", $id)->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }
        toastr()->success('User Profile update successfully');
        return back();

    }

    public function passwordUpdate(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {

            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password
        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        toastr()->success('Password Changed Successfully');
        return redirect()->back();
    }

}
