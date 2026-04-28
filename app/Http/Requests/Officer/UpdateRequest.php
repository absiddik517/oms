<?php

namespace App\Http\Requests\Officer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role == 'admin' || auth()->user()->office_id === request('office_id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'office_id'                 => ['required', 'exists:offices,id'],
            'name'                      => ['required', 'string'],
            'designation'               => ['required'],
            'suboridinate_office_name'  => ['nullable'],
            "suboridinate_office_code"  => ['nullable', 'required_with:suboridinate_office_name', 'digits:3'],
            "section_name"              => ['nullable'],
            "section_code"              => ['required_with:section_name', 'digits:3'],
            "email"                     => ['email', 'nullable'],
            "phone"                     => ['nullable', 'digits_between:11,14'],
            "status"                    => ['nullable'],
            "joining_date"              => ["nullable"],
            'leaving_date'              => ["nullable", 'required_if:status,leaved']
        ];
    }
}
