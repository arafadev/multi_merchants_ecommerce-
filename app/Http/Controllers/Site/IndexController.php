<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function home()
    {
        $categories = Category::latest()->get();

        $skip_category_0 = $categories->get(0);
        $skip_product_0 = $skip_category_0->products()->where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();

        $skip_category_2 = $categories->get(2);
        $skip_product_2 = $skip_category_2->products()->where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();

        $skip_category_7 = $categories->get(7);
        $skip_product_7 = $skip_category_7->products()->where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();


        $hot_deals = Product::where('hot_deals', 1)->whereNotNull('discount_price')->orderBy('id', 'DESC')->limit(3)->get();

        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $new = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $special_deals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();

        return view('site.index', compact('skip_category_0', 'skip_product_0', 'skip_category_2', 'skip_product_2', 'skip_category_7', 'skip_product_7', 'hot_deals', 'special_offer', 'new', 'special_deals'));
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
