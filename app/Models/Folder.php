<?php

namespace App\Models;
use App\Models\Office;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'office_id',
        'name',
        'description',
        'code',
        'is_active',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}
