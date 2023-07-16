<?php

namespace App\Http\Requests\Vendor\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'product_id' => 'required|exists:products,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'product_name' => 'required|string|max:255',
            'product_qty' => 'required|integer|min:1',
            'product_tags' => 'nullable|string|max:255',
            'product_size' => 'nullable|string|max:50',
            'product_color' => 'nullable|string|max:50',
            'selling_price' => 'required|numeric',
            'product_code' => 'required|numeric',
            'discount_price' => 'nullable|numeric|lt:selling_price',
            'short_desc' => 'required|string',
            'long_desc' => 'required|string',
            'hot_deals' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'special_offer' => 'nullable|boolean',
            'special_deals' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ];
    }
}
