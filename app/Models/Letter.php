<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BanglaDateTime\BanglaDateTime;

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

    protected $appends = ['date'];

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

    public function scopeCurrentoffice($query){
        if(auth()->user()->role === 'user'){
            $query->where('office_id', auth()->user()->office_id);
        }
    }

    

    public function getDateAttribute()
    {
        if (!$this->letter_date) {
            return [
                'gregorian' => null,
                'lunar'     => null
            ];
        }
        $output = [];
        $gregorian = BanglaDateTime::create($this->letter_date)
            ->format('jS F Y');
        $output['gregorian'] = $gregorian;

        $lunar = BanglaDateTime::create($this->letter_date)->toBangla('jS F Y');
        $output['lunar'] = $lunar;
        return $output;

    }
}
