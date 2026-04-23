<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


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
}
