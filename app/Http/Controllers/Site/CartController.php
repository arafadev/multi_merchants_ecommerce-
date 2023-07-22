<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        // Determine the price based on whether or not the product is on sale
        $price = $product->discount_price ?? $product->selling_price;

        // Add the product to the cart
        Cart::add([
            'id' => $id,
            'name' => $request->product_name,
            'qty' => $request->quantity,
            'price' => $price,
            'weight' => 1,
            'options' => [
                'image' => $product->product_thumbnail,
                'color' => $request->color,
                'size' => $request->size,
                'vendor' => $request->vendor,
            ],
        ]);
        return response()->json(['success' => 'Product successfully added to cart.']);
    }

    public function addMinCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }

    public function removeMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);
    }
}
