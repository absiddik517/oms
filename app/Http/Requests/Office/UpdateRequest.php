<?php

namespace App\Http\Requests\Office;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ministry_name' => ['required', 'array'],
            'ministry_name.bn' => ['required', 'string', 'max:255'],
            'ministry_name.en' => ['required', 'string', 'max:255'],
            'office_name' => ['required', 'array'],
            'office_name.bn' => ['required', 'string', 'max:255'],
            'office_name.en' => ['required', 'string', 'max:255'],
            'upazila' => ['nullable'],
            'upazila.bn' => ['nullable', 'string', 'max:255'],
            'upazila.en' => ['nullable', 'string', 'max:255'],
            'district' => ['required', 'array'],
            'district.bn' => ['required', 'string', 'max:255'],
            'district.en' => ['required', 'string', 'max:255'],
            'geo_code' => ['required', 'numeric', 'digits:4'],
            'ddo_code' => ['required', 'numeric', 'digits:13'],
            'ministry_code' => ['required', 'numeric', 'digits:2'],
            'office_level_code' => ['required', 'numeric', 'digits:2'],
            'section' => ['required', 'numeric', 'digits_between:1,2'],
        ];
    }

    public function attributes()
    {
        return [
            'ddo_code'  => 'DDO Code'
        ];
    }
}
