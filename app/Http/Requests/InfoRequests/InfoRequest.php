<?php

namespace App\Http\Requests\InfoRequests;

use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
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
            'name' => 'string|min:3|max:30|required',
            'email' =>'required|email',
            'phone' => 'string|min:11|required',
            'address' => 'string|required',
            'facebook' => 'string|nullable',
            'x' => 'string|nullable',
            'instagram' => 'string|nullable',
            'linkedIn' => 'string|nullable'
        ];
    }
}
