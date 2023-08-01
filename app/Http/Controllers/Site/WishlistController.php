<?php

namespace App\Http\Controllers\Site;

use Carbon\Carbon;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishList(Request $request, $product_id)
    {

        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),

                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            } else {
                return response()->json(['error' => 'This Product Has Already on Your Wishlist']);
            }
        } else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
    } // End Method
    public function wishlists()
    {
        return view('site.wishlists.index');
    } // End Method
    public function getWishlistProduct()
    {

        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();

        $wishQty = wishlist::count();

        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    }

    public function wishlistRemove($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Successfully Product Remove']);
    } // End Method

}
