<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function roles()
    {

        return view('admin.roles.index', ['roles' => Role::all()]);
    } // End Method



    public function addRole()
    {
        return view('admin.roles.create');
    }


    public function storeRole(Request $request)
    {

        $role = Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Roles Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    } // End Method
    public function editRole($id)
    {
        return view('admin.roles.edit', ['role' => Role::findOrFail($id)]);
    } // End Method


    public function updateRole(Request $request)
    {
        Role::findOrFail( $request->id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Roles Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    } // End Method


    public function deleteRole($id)
    {

        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Roles Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
}
