<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminManageController extends Controller
{


    public function admins()
    {
        $admins = Admin::latest()->get();
        return view('admin.admins.index', ['admins' => $admins]);
    }

    public function addAdmin()
    {
        $roles = Role::all();
        return view('admin.admins.create', ['roles' => $roles]);
    } // End Mehtod


    public function adminStore(Request $request)
    {

        $admin = new Admin();
        $admin->username = $request->username;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->password = Hash::make($request->password);
        $admin->save();
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }
        $notification = array(
            'message' => 'New Admin  Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admins.index')->with($notification);
    } // End Mehtod

    public function adminEdit($id)
    {

        $admin = Admin::findOrFail($id);
        $roles = Role::all();
        return view('admin.admins.edit', compact('admin', 'roles'));
    } // End Mehtod


    public function adminUpdate(Request $request, $id)
    {


        $admin = Admin::findOrFail($id);
        $admin->username = $request->username;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->save();

        $admin->roles()->detach();
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New Admin Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admins.index')->with($notification);
    } // End Mehtod

    public function deleteAdminRole($id)
    {

        $admin = Admin::findOrFail($id);
        if (!is_null($admin)) {
            $admin->delete();
        }

        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Mehtod


    

}
