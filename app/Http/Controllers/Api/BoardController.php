<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\BoardUser;
use App\Models\TaskList;
use App\Models\User;
use Session;

class BoardController extends Controller
{
    public function insert(Request $request){
        $request->validate([
            "name"=>"required"
        ]);

        $board=new Board;
        $board->name=$request->name;
        $board->save();
            
        //Add Board User
        $user=new BoardUser;
        $user->board_id=$board->id;
        $user->user_id=auth()->user()->id;
        $user->creator=1;
        $user->save();


        //Add TaskList
        $listing=["Todo","Progress","Code Review","Done"];
        foreach ($listing as $key => $value) {
            $list=new TaskList;
            $list->name=$value;
            $list->board_id=$board->id;
            $list->save();
        }
        Session::put("board_id",$board->id);

        return response()->json(['message' => "Board Successfully Added"]);
    }
    public function addMember(Request $request){
            $request->validate([
                "email"=>"email|required",
            ]);
            $board_id=Session::get("board_id");
            $userCheck=User::where("email",$request->email)->count();
            if($userCheck!=0){
                $boardUser=User::where("email",$request->email)->first();
                $check=BoardUser::where("board_id",$board_id)->where("user_id",$boardUser->id)->count();
                if($check==0){

                    $user=new BoardUser;
                    $user->board_id=$board_id;
                    $user->user_id=$boardUser->id;
                    $user->save();
                    
                   return ["status"=>"success","message"=>"Member Successfully Added"];
                }else{
                   return ["status"=>"error","message"=>"Member already exist in board"];
                }
            }else{
                return ["status"=>"error","message"=>"This Member in users does not existed"];
            }

            return response()->json(['message' => "Memeber Added"]);
    }

    public function removeMember(Request $request){
        $check=BoardUser::where("board_id",$request->board_id)->where("user_id",$request->user_id)->first();
        if($check->creator==1){
            return response()->json(['message' => "Sorry, You cannot delete this user from board. Its creator of board"]);
        }
        BoardUser::where("board_id",$request->board_id)->where("user_id",$request->user_id)->delete();
        return response()->json(['message' => "Memeber Removed"]);
    }
    
    public function setTime(Request $request){
        $request->validate([
            "timing"=>"required"
        ]);

        Board::where("id",Session::get("board_id"))->update(["set_time"=>$request->timing]);
    }

}
