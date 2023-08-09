<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function pendingReview()
    {

        $reviews = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('admin.reviews.pending', ['reviews' => $reviews]);
    }

    public function reviewApprove($id)
    {

        Review::where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function publishReview()
    {
        $reviews = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.reviews.publish',  ['reviews' => $reviews]);
    }


    public function reviewDelete($id)
    {

        Review::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
