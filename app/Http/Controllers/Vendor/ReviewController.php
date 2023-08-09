<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function reviews()
    {
        $reviews = Review::where('vendor_id', Auth::user()->id)->where('status', 1)->orderBy('id', 'DESC')->get();
        return view('vendor.reviews.approved', ['reviews' => $reviews]);
    } // End Method

}
