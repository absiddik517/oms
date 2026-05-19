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
        'short_name',  
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

    public function getShortNameAttribute(){
        $name = $this->office_name['en'];
        $short_chars_to_display = 5;
        $output = "";
        $chars = array_filter(str_split($name), function($item){
            $capitals = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
            if(in_array($item, $capitals)){
                return $item;
            }
        });
        $short_name = join('', $chars);
        $output .= $short_name;
        if($this->upazila['en']){
            $short_upazila = str_split($this->upazila['en'], $short_chars_to_display)[0];
            $output .= ', '.$short_upazila;
        }
        $short_district = str_split($this->district['en'], $short_chars_to_display)[0];
        $output .= ', '.$short_district;
        return $output;
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
