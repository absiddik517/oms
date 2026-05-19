<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasDefault;
use Illuminate\Database\Eloquent\Builder;

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

    public function office() {
        return $this->belongsTo(Office::class);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }



    
}
