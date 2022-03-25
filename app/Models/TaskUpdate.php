<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TaskUpdate extends Model
{
    public $appends =["user"];
    use HasFactory;
    public function getUserAttribute()
    {
        $user=User::where("id",$this->user_id)->first();
        return $user->first_name." ".$user->last_name;
    }
}
