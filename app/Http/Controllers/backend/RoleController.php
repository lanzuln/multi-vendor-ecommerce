<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller {
    public function AllPermission() {

        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));

    } // End Method

    public function AddPermission() {
        return view('backend.pages.permission.add_permission');
    } // End Method

    public function StorePermission(Request $request) {

        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        toastr()->success('Permission Inserted Successfully');
        return redirect()->route('all.permission');

    } // End Method

    public function EditPermission($id) {

        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));

    } // End Method

    public function UpdatePermission(Request $request) {
        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        toastr()->success('Permission Updated Successfully');

        return redirect()->route('all.permission');

    } // End Method

    public function DeletePermission($id) {

        Permission::findOrFail($id)->delete();

        toastr()->success('Permission Deleted Successfully');

        return redirect()->back();
    } // End Method

    ///////////////////// All Roles ////////////////////

    public function AllRoles() {

        $roles = Role::all();
        return view('backend.pages.roles.all_roles', compact('roles'));

    } // End Method

    public function AddRoles() {
        return view('backend.pages.roles.add_roles');
    } // End Method

    public function StoreRoles(Request $request) {

        $role = Role::create([
            'name' => $request->name,

        ]);

        toastr()->success('Roles Inserted Successfully');
        return redirect()->route('all.roles');

    } // End Method

    public function EditRoles($id) {
        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles', compact('roles'));
    } // End Method

    public function UpdateRoles(Request $request) {

        $role_id = $request->id;

        Role::findOrFail($role_id)->update([
            'name' => $request->name,

        ]);

        toastr()->success('Roles Updated Successfully');
        return redirect()->route('all.roles');

    } // End Method

    public function DeleteRoles($id) {

        Role::findOrFail($id)->delete();

        toastr()->success('Roles Deleted Successfully');
        return redirect()->back();
    } // End Method


    ///////////////// Add role Permission all method ///////////////

    public function AddRolesPermission() {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        // dd($permission_groups);
        return view('backend.pages.roles.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    } // End Method

    public function RolePermissionStore(Request $request) {

        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        toastr()->success('Role Permission Added Successfully');

        return redirect()->route('all.roles.permission');

    } // End Method

    public function AllRolesPermission() {

        $roles = Role::all();
        return view('backend.pages.roles.all_roles_permission', compact('roles'));

    } // End Method

    public function AdminRolesEdit($id) {

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.roles.role_permission_edit', compact('role', 'permissions', 'permission_groups'));
    } // End Method


    public function AdminRolesUpdate(Request $request,$id){
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
           $role->syncPermissions($permissions);
        }


        toastr()->success('Role Permission Updated Successfully');

        return redirect()->route('all.roles.permission');

    }// End Method

    public function AdminRolesDelete($id) {

        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }


        toastr()->success('Role Permission Deleted Successfully');

        return redirect()->back();

    } // End Method

}
