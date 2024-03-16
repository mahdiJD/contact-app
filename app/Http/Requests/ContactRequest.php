<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        dd($this->route('contact')->email);
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id',
        ];
        switch ($this->method()){
            case "PUT":
            case "PATCH":
                $rules['email'] ='required|email|unique:contacts,email,'
                    . $this->route('contact')->id;
                break;

        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'company_id' => 'mmm',
            'email' => 'email address'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'last_name' => $this->first_name && !$this->last_name ? $this->string('first_name')
                ->upper()->value : $this->last_name,
        ]);
    }

    public function messages()
    {
        return [
//            'email' => ':attributes خود را وارد کنید',
            '*.required' => 'please complete this filde'
        ];
    }
}
