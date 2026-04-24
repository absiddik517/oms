<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'disk',
        'uploaded_by',
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }
}
