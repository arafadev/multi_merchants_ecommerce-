<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function reports()
    {
        return view('admin.reports.index');
    } // End Method



    public function searchByDate(Request $request)
    {

        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');

        $orders = Order::where('order_date', $formatDate)->latest()->get();
        return view('admin.reports.report_by_date', compact('orders', 'formatDate'));
    } // End Method
    public function SearchByMonth(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $orders = Order::where('order_month', $request->month)->where('order_year', $request->year)->latest()->get();
        return view('admin.reports.report_by_month', compact('orders', 'month', 'year'));
    } // End Method


    public function SearchByYear(Request $request)
    {

        $year = $request->year;

        $orders = Order::where('order_year', $year)->latest()->get();
        return view('admin.reports.report_by_year', compact('orders', 'year'));
    } // End Method

    public function orderByUser()
    {
        return view('admin.reports.report_by_user', ['users' => User::latest()->get()]);
    } // End Method

    public function searchByUser(Request $request)
    {
        $user =  User::findOrFail($request->user_id);
        $orders = Order::where('user_id', $request->user_id)->latest()->get();
        return view('admin.reports.report_by_user_show', compact('orders', 'user'));
    } // End Method

}
