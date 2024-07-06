<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'website' => 'nullable|url|max:150', // http://google.com
            'email' => 'required|email|unique:companies,email',
            'address' => 'nullable'
        ];


        switch($this->method()){
            case "PUT":
            case "PATCH":
                $rules['email'] = 'required|email|unique:companies,email,'
                . $this->route('company')->id;
                break;
        }

//        $this->dd($rules);
        return $rules;
    }
}
