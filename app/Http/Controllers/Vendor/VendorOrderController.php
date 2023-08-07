<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{

    public function orders()
    {

        $orderitem = OrderItem::with('order')->where('vendor_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('vendor.orders.pending_order', compact('orderitem'));
    }
    public function returnOrders()
    {
        $orderitems = OrderItem::with('order')->where('vendor_id',  Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('vendor.orders.return_orders', ['orderitems' => $orderitems]);
    } // End Method
    public function completeReturnOrder()
    {
        $orderitem = OrderItem::with('order')->where('vendor_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('vendor.orders.complete_return_orders', compact('orderitem'));
    } // End Method
    public function orderDetails($order_id)
    {

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('vendor.orders.order_details', compact('order', 'orderItem'));
    } // End Method
}
