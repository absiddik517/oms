<?php

namespace App\Rules\Subject;

use App\Models\Subject;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UniqueSubjectRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    
    protected $officeId;
    protected $skipId;
    public function __construct($officeId, $skip_id = null)
    {
        $this->officeId = $officeId;
        $this->skipId = $skip_id;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Subject::where('name', $value)
                        ->where('office_id', $this->officeId);
        if ($this->skipId) {
            $query->where('id', '!=', $this->skipId);
        }
        $exists = $query->exists();
        if ($exists) {
            $fail('The :attribute must be unique. '.$this->skipId);
        }
    }
}
