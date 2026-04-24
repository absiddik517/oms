<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subject;

class Office extends Model
{




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'office_name',
        'upazila',
        'district',
        'geo_code',
        'office_code',
    ];

    public function subjects()
    {
        return Subject::where(function ($query) {
            $query->where('office_id', $this->id)
                  ->orWhereNull('office_id');
        });
    }

}
