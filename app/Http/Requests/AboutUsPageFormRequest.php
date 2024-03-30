<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsPageFormRequest extends FormRequest
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
//            'title' => 'required|string|between:50,100',
//            'description'  => 'required|string|between:200,350',
            'subtitle' => 'required|string|max:200',
            'details'  => 'required|string|max:2000',
        ];
    }
}
