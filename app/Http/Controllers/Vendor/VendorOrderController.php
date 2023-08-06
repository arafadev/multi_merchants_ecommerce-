<?php

namespace App\Http\Controllers\Vendor;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{

    public function vendorOrder()
    {

        $orderitem = OrderItem::with('order')->where('vendor_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('vendor.orders.pending_order', compact('orderitem'));
    }
}
