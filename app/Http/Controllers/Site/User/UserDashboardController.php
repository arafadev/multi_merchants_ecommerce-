<?php

namespace App\Http\Controllers\Site\User;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{

    public function userAccount()
    {
        $userData = User::find(Auth::user()->id);
        return view('site.user.dashboard.account.details', compact('userData'));
    }

    public function userChangePassword()
    {
        return view('site.user.dashboard.account.change_password');
    }

    public function orderPage()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('site.user.dashboard.account.order', compact('orders'));
    } // End Method
    public function userOrderDetails($order_id)
    {

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItems = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('site.user.dashboard.account.order_details', compact('order', 'orderItems'));
    } // End Method

    public function userOrderInvoice($order_id)
    {

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('site.user.dashboard.order_download', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    } // End Method
}
