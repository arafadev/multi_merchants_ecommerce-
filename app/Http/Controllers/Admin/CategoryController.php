<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\UploadPhotoTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use UploadPhotoTrait;
    public function categories()
    {
        return view('admin.category.index', ['categories' => Category::latest()->get()]);
    }
    public function addCategory()
    {
        return view('admin.category.create');
    }

    public function storeCategory(StoreCategoryRequest $request)
    {

        $validatedData  = $request->validated();
        $filename = '';
        if ($request->file('image')) {
            $filename = $this->uploadPhoto($request->file('image'), 'upload/category_images', true, 120, 120);
        }

        Category::create([
            'name'  => $validatedData['name'],
            'image' => $filename,
            'slug' => strtolower(str_replace(' ', '-', $validatedData['name'])),
        ]);
        $response = [
            'success' => true,
            'message' => 'Category Stored Successfully'
        ];
        return response()->json($response);
    }

    public function editCategory($id)
    {
        return view('admin.category.edit', ['category' => Category::findOrFail($id)]);
    }

    public function updateCategory(UpdateCategoryRequest $request, $id)
    {
        $image = Category::findOrFail($id)->image;
        $validatedData  = $request->validated();
        if ($request->file('image')) {
            $filename = $this->uploadPhoto($request->file('image'), 'upload/category_images', true, 120, 120);
            @unlink(public_path('upload/category_images/' . $image));
        } else {
            $filename = $image;
        }

        Category::findOrFail($id)->update([
            'name'  => $validatedData['name'],
            'image' => $filename,
            'slug' => strtolower(str_replace(' ', '-', $validatedData['name'])),
        ]);
        $response = [
            'success' => true,
            'message' => 'Category Updated Successfully'
        ];
        return response()->json($response);
    }
    public function deleteCategory($id)
    {
        $category  = Category::findOrFail($id);
        @unlink(public_path('upload/category_images/' . $category->image));
        $category->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
    }
}
