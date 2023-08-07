<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use App\Http\Controllers\Controller;

class ActiveVendorController  extends Controller
{
    public function vendors()
    {
        return view('admin.active.vendors.index', ['vendors' => Vendor::latest()->get()]);
    }
}
