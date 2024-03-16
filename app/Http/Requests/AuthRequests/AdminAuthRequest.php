<?php

namespace App\Http\Requests\AuthRequests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAuthRequest extends FormRequest
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
            "role_id" =>"required|numeric",
            "name" => "required|string|min:3|max:50",
            "email"=> "required|email",
            "password"=> "required|confirmed|min:6",
            "phone"=> "min:11|nullable",
            "address"=> "string|nullable",
        ];
    }
}
