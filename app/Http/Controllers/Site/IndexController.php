<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function home()
    {
        return view('site.index');
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        $product_color = explode(',', $product->product_color);
        $product_size = explode(',', $product->product_size);
        $product_tags = explode(' ', $product->product_tags);
        $multiImage = MultiImg::where('product_id', $id)->get();;
        $relatedProduct = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();
        return view('site.products.details', compact('product', 'product_color', 'product_size', 'multiImage', 'relatedProduct', 'product_tags'));
    }
}
