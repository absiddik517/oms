<?php

namespace App\Http\Requests\Subject;

use App\Models\Subject;
use App\Rules\Subject\UniqueSubjectRule;
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
            'office_id' => ['nullable', 'exists:offices,id'],
            'name' => [
                'required', 'string', 
                new UniqueSubjectRule(
                        $this->office_id, 
                        $this->route('subject')
                    )
            ],
            'code' => ['required'],
        ];
    }
}
