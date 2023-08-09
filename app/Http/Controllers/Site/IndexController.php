<?php

namespace App\Http\Controllers\Site;

use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
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

    public function vendorDetails($id)
    {

        $vendor = Vendor::findOrFail($id);
        $vproduct = Product::where('vendor_id', $id)->get();
        return view('site.vendor.vendor_details', compact('vendor', 'vproduct'));
    }

    public function allVendor()
    {

        $vendors = Vendor::where('status', 'active')->get();
        return view('site.vendor.all_vendor', ['vendors' => $vendors]);
    } // End Method

    public function CatWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();

        return view('frontend.product.category_view', compact('products', 'categories'));
    } // End Method


    public function catWithProducts(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('name', 'asc')->limit(5)->get();
        $category = Category::findOrFail($id);
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        $breadcat = Category::where('id', $id)->first();

        return view('site.products.category_view', compact('products', 'categories', 'category', 'newProduct', 'breadcat'));
    }

    public function subCatWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('name', 'ASC')->limit(5)->get();
        $breadsubcat = SubCategory::where('id', $id)->first();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('site.products.subcategory_view', compact('products', 'categories', 'breadsubcat', 'newProduct'));
    }

    public function productViewAjax($id)
    {

        $product = Product::with('category', 'brand')->findOrFail($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
            'vendor_name' => $product->vendor->name,
        ));
    }


    public function productSearch(Request $request)
    {

        $request->validate(['search' => "required"]);
        $item = $request->search;
        $categories = Category::orderBy('name', 'ASC')->get();
        $products = Product::where('product_name', 'LIKE', "%$request->search%")->get();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        return view('site.products.search', compact('products', 'item', 'categories', 'newProduct'));
    } // End Method


    public function searchProduct(Request $request)
    {

        $request->validate(['search' => "required"]);

        $products = Product::where('product_name', 'LIKE', "%$request->search%")->select('product_name', 'product_slug', 'product_thumbnail', 'selling_price', 'id')->limit(6)->get();

        return view('site.products.search_product_result', ['products' => $products]);
    } // End Method

}
