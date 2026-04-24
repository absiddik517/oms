<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = [
        'office_id',
        'topic_id',
        'folder_id',
        'letter_number',
        'subject',
        'body',
        'letter_date',
        'status',
        'created_by',
        'updated_by',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }      

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
     /*
    |----------------------------
    | Recipients (Polymorphic)
    |----------------------------
    */

     public function recipients()
    {
        return $this->morphToMany(
            Recipient::class,
            'recipientable',
            'recipientables'
        )->withPivot('type');
    }

    // Main receiver (TO)
    public function to()
    {
        return $this->recipients()->wherePivot('type', 'to');
    }

    // Carbon copy (CC)
    public function cc()
    {
        return $this->recipients()->wherePivot('type', 'cc');
    }

     public function attachments()
    {
        return $this->morphToMany(
            Attachment::class,
            'attachable',
            'attachables'
        );
    }
}
