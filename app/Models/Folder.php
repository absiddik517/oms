<?php

namespace App\Models;
use App\Models\Office;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Folder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

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
