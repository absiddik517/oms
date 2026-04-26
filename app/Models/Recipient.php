<?php

namespace App\Models;

use App\Helpers\HasDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    protected static function booted()
    {
        static::addGlobalScope('current_office', function (Builder $builder) {
            if(auth()->user()->role === 'user'){
                $builder->where('office_id', auth()->user()->office_id)
                        ->orWhereNull('office_id');
            }
        });
    }

    public function scopeCurrentoffice($query){
        if(auth()->user()->role === 'user'){
            $query->where('office_id', auth()->user()->office_id)
                ->orWhereNull('office_id');
        }
    }

    
}
