<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Label;
use App\Models\User;

class Task extends Model
{
    use HasFactory;
    
    public $appends =["labelname",'username'];
    
    public function getLabelnameAttribute()
    {
        if($this->label_id!=""){
            return Label::where("id",$this->label_id)->first()->name;
        }else{
            return "";
        }
    }
    public function getUsernameAttribute()
    {
        if($this->member_id!=""){
            $data=User::where("id",$this->member_id)->first();
            return $data->first_name." ".$data->last_name;
        }else{
            return "";
        }
    }
}
