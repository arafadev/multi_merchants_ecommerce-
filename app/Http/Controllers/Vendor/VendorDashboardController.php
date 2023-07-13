<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorDashboardController extends Controller
{
    public function index()
    {
        $status = Vendor::find(Auth::id())->status;
        return view('vendor.index', ['status' => $status]);
    }
}
