<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionRoleController extends Controller
{

    public function permissionRoles()
    {
        return view('admin.permission_roles.index', ['roles' =>  Role::all()]);
    }
    public function addRolesPermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = Admin::getPermissionGroups();
        return view('admin.permission_roles.create', compact('roles', 'permissions', 'permission_groups'));
    }


    public function rolePermissionStore(Request $request)
    {

        $data = array();

        foreach ($request->permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permission_roles.index')->with($notification);
    }


    public function adminRolesEdit($id)
    {

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = Admin::getPermissionGroups();
        return view('admin.permission_roles.edit', compact('role', 'permissions', 'permission_groups'));
    }

    public function adminRolesUpdate(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permission_roles.index')->with($notification);
    }
    public function AdminRolesDelete($id)
    {

        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }

        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
}
