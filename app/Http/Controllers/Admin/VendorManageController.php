<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorManageController extends Controller
{


    public function inactiveVendor()
    {
        return view('admin.vendor_manage.inactive', ['inActive' => Vendor::where('status', 'inactive')->latest()->get()]);
    }


    public function InactiveVendorDetails($id)
    {
        return view('admin.vendor_manage.inactive_details', [
            'inactiveVendorDetails' => Vendor::where('id', $id)->where('status', 'inactive')->first()
        ]);
    }

    public function adminActiveVendor($id)
    {
        Vendor::findOrFail($id)->update(['status' =>  'active']);
        $notification = array(
            'message' => 'Vendor Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.inactive')->with($notification);
    }

    public function activeVendors()
    {
        return view('admin.vendor_manage.active', ['actives' => Vendor::where('status', 'active')->latest()->get()]);
    }


    public function activeVendorDetails($id)
    {
        return view('admin.vendor_manage.active_details', [
            'activeVendorDetails' => Vendor::where('id', $id)->where('status', 'active')->first()
        ]);
    }

    public function adminInactiveVendor($id)
    {
        Vendor::findOrFail($id)->update(['status' =>  'inactive']);
        $notification = array(
            'message' => 'Vendor InActive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('active.vendors')->with($notification);
    }
}
