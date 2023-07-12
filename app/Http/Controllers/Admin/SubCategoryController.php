<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\Admin\SubCategory\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
    public function subcategories()
    {
        return view('admin.subcategories.index', ['subcategories' => SubCategory::latest()->get()]);
    }
    public function addSubCategory()
    {
        return view('admin.subcategories.create', ['categories' => Category::latest()->get()]);
    }

    public function storeSubCategory(StoreSubCategoryRequest $request)
    {
        $validatedData = $request->validated();

        SubCategory::create([
            'name' => $validatedData['name'],
            'category_id'   => $validatedData['category_id'],
            'slug' => strtolower(str_replace(' ', '-', $validatedData['name'])),
        ]);

        $response = [
            'success' => true,
            'message' => 'SubCategory Stored Successfully'
        ];

        return response()->json($response);
    }



    public function editSubCategory($id)
    {
        return view('admin.subcategories.edit', [
            'categories' => Category::latest()->get(),
            'subcategory' => SubCategory::findOrFail($id)

        ]);
    }
    public function updateSubCategory(UpdateSubCategoryRequest $request, $id)
    {

        $validatedData = $request->validated();

        SubCategory::findOrFail($id)->update([
            'name' => $validatedData['name'],
            'category_id'   => $validatedData['category_id'],
            'slug' => strtolower(str_replace(' ', '-', $validatedData['name'])),
        ]);

        $response = [
            'success' => true,
            'message' => 'SubCategory Stored Successfully'
        ];

        return response()->json($response);
    }

    public function deleteSubCategory($id)
    {
        SubCategory::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'SubCategory deleted successfully.']);
    }
}
