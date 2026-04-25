<?php

namespace App\Models;

use App\Helpers\HasDefault;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasDefault;
    
    protected $fillable = [
        'office_id',
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

    public function scopeCurrentoffice($query){
        if(auth()->user()->role === 'user'){
            $query->where('office_id', auth()->user()->office_id)
                ->orWhereNull('office_id');
        }
    }
}
