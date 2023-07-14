<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Traits\UploadPhotoTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Requests\Admin\Product\UpdateMultiImageRequest;

class ProductController extends Controller
{
    use UploadPhotoTrait;
    public function products()
    {
        return view('admin.products.index', ['products' =>  Product::latest()->get()]);
    }
    public function addProduct()
    {
        $activeVendors = Vendor::where('status', 'active')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::select('name', 'id')->get();
        return view('admin.products.create', compact('brands', 'categories', 'activeVendors'));
    }

    public function storeProduct(StoreProductRequest $request)
    {
        $save_url = $this->uploadPhoto($request->file('product_thumbnail'), 'upload/product_thumbnail', 'product_thumbnail', 800, 800);
        $data = collect($request->validated())->except(['multi_img'])->toArray();
        $data['product_thumbnail'] = $save_url;
        $data['product_slug'] = strtolower(str_replace(' ', '-', $request->product_name));
        $data['status'] = 1;
        $data['created_at'] = Carbon::now();
        $product_id = Product::insertGetId($data);

        $save_urls = $this->uploadMultiImages($request, 'multi_img', 'product_multi_imgs', 800, 800);

        $multi_images = [];

        foreach ($save_urls as $save_url) {
            $multi_images[] = [
                'product_id' => $product_id,
                'photo_name' => $save_url,
                'created_at' => Carbon::now(),
            ];
        }

        MultiImg::insert($multi_images);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('products')->with($notification);
    }

    public function getSubcategory($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return json_decode($subcategories);
    }

    public function editProduct($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();
        $activeVendor = Vendor::where('status', 'active')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('brands', 'categories', 'activeVendor', 'product', 'subcategory', 'multiImgs'));
    }

    public function updateProduct(UpdateProductRequest $request)
    {
        $data = $request->except('product_id');
        $data = $data +  [
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'status' => 1,
            'created_at' => Carbon::now(),
        ];
        Product::findOrFail($request->product_id)->update($data);
        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('products')->with($notification);
    }

    public function updateProductThumbnail(Request $request)
    {
        $save_url = $this->uploadPhoto($request->product_thumbnail, 'upload/product_thumbnail', 'product_thumbnail', 800, 800);
        if ($request->old_img) {
            $url_parts = parse_url($request->old_img);
            $local_path = public_path($url_parts['path']);
            if (file_exists($local_path)) {
                unlink($local_path);
            }
        }
        Product::findOrFail($request->product_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Image thumbnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function UpdateProductMultiImage(UpdateMultiImageRequest $request)
    {
        foreach ($request->multi_img as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            @unlink(public_path($imgDel->photo_name));
        }

        $multi_images = [];

        foreach ($request->multi_img as $id => $img) {
            $save_url = $this->uploadPhoto($img, 'upload/product_multi_imgs', 'multi_imgs', 800, 800);

            $multi_images[] = [
                'product_id' => $request->product_id,
                'photo_name' => $save_url,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        MultiImg::where('product_id', $request->product_id)->delete();
        MultiImg::insert($multi_images);

        $notification = array(
            'message' => 'Product Multi Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteProductMultiImage($id)
    {
        $img = MultiImg::findOrFail($id);
        unlink('upload/product_multi_imgs/' . $img->photo_name);
        $img->delete();

        $notification = array(
            'message' => 'Product  Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            @unlink('upload/product_thumbnail/' . $product->product_thumbnail);

            $multi_images = $product->multiImages;
            foreach ($multi_images as $image) {
                @unlink(public_path($image->photo_name));
                $image->delete();
            }
            $product->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
