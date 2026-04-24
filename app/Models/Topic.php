<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasDefault;

class Topic extends Model
{
    use HasDefault;
    
    public static $autofillOnCreate = ['created_by'];
    public static $autofillOnUpdate = ['updated_by']; 

    protected $fillable = [
        'office_id',
        'name',
        'code',
        'created_by',
        'updated_by',
    ];

    
}
