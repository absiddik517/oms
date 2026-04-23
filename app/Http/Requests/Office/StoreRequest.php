<?php

namespace App\Http\Requests\Office;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'office_name' => ['required', 'array'],
            'office_name.bn' => ['required', 'string', 'max:255'],
            'office_name.en' => ['required', 'string', 'max:255'],
            'upazila' => ['required', 'array'],
            'upazila.bn' => ['required', 'string', 'max:255'],
            'upazila.en' => ['required', 'string', 'max:255'],
            'district' => ['required', 'array'],
            'district.bn' => ['required', 'string', 'max:255'],
            'district.en' => ['required', 'string', 'max:255'],
            'geo_code' => ['required', 'numeric', 'digits_between:3,4'],
            'office_code' => ['required', 'numeric', 'digits_between:12,13'],
        ];
    }
}
