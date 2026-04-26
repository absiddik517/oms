<?php

namespace App\Models;

use App\Helpers\HasDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Officer extends Model
{
    use HasDefault;

    protected $fillable = [
        'name',
        'designation',
        'category',
        'address',
        'email',
        'phone',
        'status',
        'joining_date',
        'leaving_date',
        'office_id',
        'created_by',
        'updated_by',
    ];

    public static $autofillOnCreate = ['created_by'];
    public static $autofillOnUpdate = ['updated_by'];


    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * Define scope for the model.
     *
     * @return array
     */
    public function scopeCurrentoffice($query){
        if(auth()->user()->role === 'user'){
            $query->where('office_id', auth()->user()->office_id);
        }
    }

    protected static function booted()
    {
        static::addGlobalScope('current_office', function (Builder $builder) {
            if(auth()->user()->role === 'user'){
                $builder->where('office_id', auth()->user()->office_id)
                        ->orWhereNull('office_id');
            }
        });
    }
}
