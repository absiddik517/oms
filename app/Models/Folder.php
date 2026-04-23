<?php

namespace App\Models;
use App\Models\Office;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Folder extends Model
{
    use HasFactory;
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
