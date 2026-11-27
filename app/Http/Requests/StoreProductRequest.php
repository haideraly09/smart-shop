<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       return [
        'name'            => ['required', 'string', 'max:255'],
        'sku'             => ['required', 'string', 'max:100', 'unique:products,sku'],
        'price'           => ['required', 'numeric', 'min:0'],
        'cost_price'      => ['nullable', 'numeric', 'min:0'],
        'quantity'        => ['required', 'integer', 'min:0'],
        'low_stock_limit' => ['required', 'integer', 'min:0'],
        'image'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        'description'     => ['nullable', 'string'],
        'category_id'     => ['nullable', 'exists:categories,id'],
        'brand_id'        => ['nullable', 'exists:brands,id'],
        'supplier_id'     => ['nullable', 'exists:suppliers,id'],
    ];
    }
}
