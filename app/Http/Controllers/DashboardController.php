<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Board;
use App\Models\BoardUser;
use App\Models\TaskList;
use App\Models\Label;
use App\Models\TaskUpdate;
use App\Models\User;
use Session;


class DashboardController extends Controller
{
    public function index(Request $request){
        return view("dashboard");
    }
    public function getBoardData(Request $request){
        $boardData=Board::where("id",$request->id)->first();
        $board=[
            "id"=>$boardData->id,
            "name"=>$boardData->name,
            "set_time"=>$boardData->set_time,
        ];
      
        
        $data=$board;
        $listes=TaskList::where("board_id",$boardData->id)->get();
        $data["List"]=[];
        $data["ListCards"]=[];
        foreach ($listes as $key => $value) {
            $data["List"][]=[
                    "id"=>$value->id,
                    "name"=>$value->name,
            ];
            $cards=Task::where("list_id",$value->id)->where(function($q) use ($request) {
                if(isset($request->query) && $request->query!=""){
                    $q->where('title',"LIKE","%".$request["query"]."%");
                    $q->where('description',"LIKE","%".$request["query"]."%");
                }
                if(isset($request->member) && $request->member!="all"){
                    $q->where('member_id',$request["member"]);
                }
                if(isset($request->label) && $request->label!="all"){
                    $q->where('label_id',$request["label"]);
                }
            })
            ->get();
            $data["ListCards"][$value->id]=$cards;
            /*$cards=Task::where("list_id",$value->id)->where(function($q) use ($request) {
                if(isset($request->query) && $request->query!=""){
                    $q->where('title',"LIKE","%".$request["query"]."%");
                    $q->where('description',"LIKE","%".$request["query"]."%");
                }
                if(isset($request->member) && $request->member!="all"){
                    $q->where('member_id',$request["member"]);
                }
                if(isset($request->label) && $request->label!="all"){
                    $q->where('label_id',$request["label"]);
                }
            })
            ->get();

            
            foreach ($cards as $key => $card) {
                $label="";
                if($card->label_id!=""){
                    $label=Label::where("id",$card->label_id)->first()->name;
                }
                $member="unassign";
                if($card->member_id!=""){
                    $member=User::where("id",$card->member_id)->first();
                }
                
                $data["List"][$value->id]["cards"][$card->id]=[
                    "id"=>$card->id,
                    "title"=>$card->title,
                    "description"=>$card->description,
                    "label"=>$label,
                    "label_id"=>$card->label_id,
                    "member"=>$member,
                    "member_id"=>$card->member_id,
                ];
                
                $Updates=TaskUpdate::where("task_id",$card->id)->get();
                foreach ($Updates as $key => $update) {
                    $data["List"][$value->id]["cards"][$card->id]["updates"][]=[
                        "user_id"=>$update->user_id,
                        "user"=>User::where("id",$update->user_id)->first(),
                        "text"=>$update->updateText
                    ];
                }
            }*/
        }
        $data["labels"]=Label::all();
        $boardUsers=BoardUser::where("board_id",$boardData->id)->pluck('user_id');
        $data["BoardUser"]=User::whereIn("id", $boardUsers)->get();
        $data["NonBoardUser"]=User::whereNotIn("id",$boardUsers)->get();

        return $data;
    }

    public function relocate(Request $request){
            Task::where("id",$request->id)->update([
                "list_id"=>$request->list_id,
            ]);
    
            return response()->json(['message' => "Task Relocated Successfully"]);
    }
    public function selectBoard($id){

        Session::put("board_id",$id);
        return redirect()->route('dashboard');
    }
}
