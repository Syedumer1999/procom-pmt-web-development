<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BoardUser;

class Board extends Model
{
    use HasFactory;

    public static function getList(){
        $data=BoardUser::where("user_id",auth()->user()->id)->pluck('board_id');
        $boards=Board::whereIn("id",$data)->get();
        return $boards;
       
    }
    public static function getListOne(){
        $data=BoardUser::where("user_id",auth()->user()->id)->pluck('board_id');
        if($data){
            $boards=Board::whereIn("id",$data)->first();
            if(isset($boards->id)){
                return $boards->id;
            }else{
                return "";
            }
        }else{
            return "";
        }
    }
}
