<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexPageImageFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image_file' => 'required|image|max:5120',
/*
            'banner_image' => 'nullable|file|max:5120',
            'feature_banner_image1' => 'nullable|file|max:5120',
            'feature_banner_image2' => 'nullable|file|max:5120',
            'feature_banner_image3' => 'nullable|file|max:5120',
*/
        ];
    }
}
