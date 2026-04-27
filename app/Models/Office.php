<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = []; 
    protected $appends = [
        'name_bn', 
        'name_en',
        
    ];
    protected $casts = [
        'ministry_name' => 'array',
        'office_name' => 'array',
        'upazila' => 'array',
        'district' => 'array',
    ];

    public function topics()
    {
        return Topic::where(function ($query) {
            $query->where('office_id', $this->id)
                  ->orWhereNull('office_id');
        });
    }

   
    
    public function getNameBnAttribute()
    {
        $string = '';
        $string .= $this->office_name['bn'];
        if($this->upazila['bn'] !== null){
            $string .= ', '.$this->upazila['bn'];
        }
        $string .= ', '. $this->district['bn'];
        return $string;
    }

    public function getNameEnAttribute()
    {
        $string = '';
        $string .= $this->office_name['en'];
        if($this->upazila['en'] !== null){
            $string .= ', '.$this->upazila['en'];
        }
        $string .= ', '. $this->district['en'];
        return $string;
    }
    

}
