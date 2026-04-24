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

    public function scopeCurrentoffice($query){
        $query->where('office_id', auth()->user()->office_id)
                ->orWhereNull('office_id');
    }

    
}
