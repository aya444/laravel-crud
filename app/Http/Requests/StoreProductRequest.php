<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'price.required' => 'The price field is required.',
            'quantity.required' => 'The quantity field is required.',
            'image.required' => 'The image field is required.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image field must not be greater than 2MB.',
        ];
    }
}
