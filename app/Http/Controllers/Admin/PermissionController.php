<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function permissions()
    {
        return view('admin.permissions.index', ['permissions' => Permission::all()]);
    }

    public function addPermission()
    {
        return view('admin.permissions.create');
    } // End Method
    public function storePermission(Request $request)
    {

        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function editPermission($id)
    {

        return view('admin.permissions.edit', ['permission' => Permission::findOrFail($id)]);
    } // End Method



    public function updatePermission(Request $request)
    {
        Permission::findOrFail($request->id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permissions.index')->with($notification);
    } // End Method


    public function DeletePermission($id)
    {

        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

}
