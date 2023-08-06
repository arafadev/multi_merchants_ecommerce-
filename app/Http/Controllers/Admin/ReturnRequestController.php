<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnRequestController extends Controller
{

    public function returnRequest()
    {

        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();
        return view('admin.orders.return_orders.index', compact('orders'));
    } // End Method
    public function returnRequestApproved($order_id)
    {

        Order::where('id', $order_id)->update(['return_order' => 2]);

        $notification = array(
            'message' => 'Return Order Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function completeReturnRequest()
    {
        $orders = Order::where('return_order', 2)->orderBy('id', 'DESC')->get();
        return view('admin.orders.return_orders.complete_return_request', compact('orders'));
    } // End Method


}
