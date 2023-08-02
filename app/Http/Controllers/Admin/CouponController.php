<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Coupon\CouponStoreRequest;
use App\Http\Requests\Admin\Coupon\CouponUpdateRequest;

class CouponController extends Controller
{
    public function coupons()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }
    public function addCoupon()
    {
        return view('admin.coupons.create');
    }

    public function storeCoupon(CouponStoreRequest $request)
    {

        Coupon::insert($request->validated() + ['created_at' => Carbon::now()]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('coupons')->with($notification);
    } // End Method


    public function editCoupon($id)
    {

        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    } // End Method

    public function updateCoupon(CouponUpdateRequest $request)
    {

        Coupon::findOrFail($request->id)->update($request->validated() + ['created_at' => Carbon::now()]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('coupons')->with($notification);
    } // End Method

    public function deleteCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        if ($coupon) {
            $coupon->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
