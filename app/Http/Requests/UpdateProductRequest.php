<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ];

        // Add image validation only if a new image is being uploaded
        if ($this->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'price.required' => 'Product price is required.',
            'quantity.required' => 'Product quantity is required.',
            'image.required' => 'The image field is required.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image field must not be greater than 2MB.',
        ];
    }
}
