<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomePageFormRequest extends FormRequest
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
            'bannerTitle'      => 'required|string|max:200',
            'homeTitle'      => 'required|string|max:200',
            'homeDescription'  => 'required|string|max:2000',
//            'banner_image'        => 'nullable|image|max:5120',
        ];
    }
}
