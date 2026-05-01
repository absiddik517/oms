<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BanglaDateTime\BanglaDateTime;
use Illuminate\Database\Eloquent\Builder;

class Letter extends Model
{
    protected $fillable = [
        'office_id',
        'officer_id',
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


    protected $appends = ['date', 'memo_number'];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }  
    public function officer()
    {
        return $this->belongsTo(Officer::class);
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

    public function getMemoNumberAttribute(){
        $office = $this->office;
        $officer = $this->officer;
        $topic = $this->topic;
        $folder = $this->folder;
        $codes = join('.', [
            $office->ministry_code,
            $office->office_level_code,
            $office->geo_code,
            $officer->suboridinate_office_code,
            $officer->section_code,
            $topic->code,
            $folder->code,
            date('y', strtotime($folder->creation_date)),
        ]);
        $codes .= '-'.$this->letter_number;
        return $codes;
    }
}
