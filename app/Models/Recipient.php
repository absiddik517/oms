<?php

namespace App\Models;

use App\Helpers\HasDefault;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasDefault;
    
    protected $fillable = [
        'name',
        'designation',
        'organization',
        'address',
        'email',
        'phone',
        'created_by',
        'updated_by',
    ];

    public static $autofillOnCreate = ['created_by'];
    public static $autofillOnUpdate = ['updated_by'];
}
