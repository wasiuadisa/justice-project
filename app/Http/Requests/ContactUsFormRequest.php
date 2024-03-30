<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Import model class
use App\Models\Contactuscategory;

// Import class for list of categories
//use Illuminate\Support\Facades\DB;
use App\Logic\ContactusCategoryLogic;

class ContactUsFormRequest extends FormRequest
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
        $categoriesClass = new ContactusCategoryLogic();
        $categories_object = $categoriesClass->listAllContactUsCategoryNames();
        $categories_array = json_decode(json_encode($categories_object), true);

        return [
            'category' => 'required|string|in:'.implode(',', $categories_array),
            'firstname' => 'required|alpha|between:3,20', //string
            'surname' => 'required|alpha|between:3,20', //string
            'phone' => 'string|between:6,20',
            'email' => 'required|email|between:5,50', //string
            'title' => 'required|string|max:20', //string
            'message' => 'required|string|min:50', //string
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
/*            'firstname.required' => 'Your first name is required',
            'firstname.alpha' => 'Your first name is not valid',
            'firstname.between:3,20' => 'Your first name should be between 3 and 20 characters',
            'surname.required' => 'Your surname is required',
            'surname.alpha' => 'Your surname is not valid',
            'surname.between:3,20' => 'Your surname should be between 3 and 20 characters',
            'phone.required' => 'Your phone number is required',
            'phone.alpha' => 'Your phone number is not valid',
            'phone.between:7,15' => 'Your phone number should be between 3 and 15 characters',
            'email.required' => 'Your email address is required',
            'email.email:filter,rfc,dns' => 'Your email address is not valid',
            'email.between:7,50' => 'Your email address should be less than 50 characters',
            'title.required' => 'Your title is required',
            'title.string' => 'Your title is not valid',
            'title.between:7,40' => 'Your title should be less than 40 characters',
            'message.required' => 'Your message is required',
            'message.string' => 'Your message is not valid',
            'message.between:100,1500' => 'Your message should be less than 1500 characters',
*/        ];
    }
}
