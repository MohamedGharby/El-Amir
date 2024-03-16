<?php

namespace App\Http\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "item_id"=> "required|numeric|exists:items,id",
            "name"=> "string|required|min:3|max:50",
            "code"=> "required|string",
            "desc"=> "nullable|string",
            "color"=> "string|nullable|min:3|max:50",
            "dimension"=> "string|nullable|min:3|max:50",
            "cc"=> "nullable|numeric",
            "weight"=> "nullable",
            "price"=> "required",
            "percentage" => "nullable",
            "img"=> "image|nullable|mimes:jpg,png,jpeg,webp",
        ];
    }
}
