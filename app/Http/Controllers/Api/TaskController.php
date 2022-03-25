<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Board;
use App\Models\BoardUser;
use App\Models\TaskList;
use App\Models\Label;
use App\Models\TaskUpdate;
use App\Models\User;

class TaskController extends Controller
{
    public function insert(Request $request){
        $request->validate([
            "title"=>"required",
        ]);

            $task=new Task;
            $task->list_id=$request->list_id;
            $task->title=$request->title;
            $task->description=$request->description;
            $task->user_id=auth()->user()->id;
            $task->save();
            
        return response()->json(['message' => "Task Added Successfully"]);
    }

    public function getTask(Request $request){
        $task=Task::where("id",$request->id)->first();
        $task["updates"]=TaskUpdate::where("task_id",$task->id)->get();
        return $task;
    }
    public function addUpdate(Request $request){
        $update=new TaskUpdate;
        $update->task_id=$request->task_id;
        $update->user_id=auth()->user()->id;
        $update->updateText=$request->updateText;
        $update->save();
    }
    public function update(Request $request){
        $request->validate([
            "id"=>"required",
            "title"=>"required",
        ]);

        Task::where("id",$request->id)->update([
            "title"=>$request->title,
            "description"=>$request->description,
        ]);

        return response()->json(['message' => "Task Updated Successfully"]);
    }
    
    public function delete(Request $request){
        Task::where("id",$request->id)->delete();

        return response()->json(['message' => "Task Deleted Successfully"]);

    }
    public function relocate(Request $request){
        $request->validate([
            "id"=>"required",
            "list_id"=>"required",
        ]);

        Task::where("id",$request->id)->update([
            "list_id"=>$request->list_id,
        ]);

        return response()->json(['message' => "Task Relocated Successfully"]);

    }

    public function assign(Request $request){
        $data=[];
        if($request->assignMember!="un"){
            $data["member_id"]=$request->assignMember;
        }
        if($request->assignLabel!="un"){
            $data["label_id"]=$request->assignLabel;
        }
        Task::where("id",$request->task_id)->update($data);

        return response()->json(['message' => "Task Assigned Successfully"]);
    }
    public function addLabel(Request $request){
        $request->validate([
            "id"=>"required",
            "label_id"=>"required",
        ]);

        Task::where("id",$request->id)->update([
            "label_id"=>$request->label_id,
        ]);

        return response()->json(['message' => "Task Labeled Successfully"]);
    }
    public function searchQuery(Request $request){
        //Board Data
        $boardData=Board::where("id",$request->id)->first();
        $board=[
            "id"=>$boardData->id,
            "name"=>$boardData->name,
            "set_time"=>$boardData->set_time,
        ];
      
        
        $data=$board;
        $listes=TaskList::where("board_id",$boardData->id)->get();
        $data["List"]=[];
        foreach ($listes as $key => $value) {
            
            $data["List"][$value->id]=[
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
            }
        }
        $data["labels"]=Label::all();
        $boardUsers=BoardUser::where("board_id",$boardData->id)->pluck('user_id');
        $data["BoardUser"]=User::whereIn("id",[ $boardUsers])->get();
        $data["NonBoardUser"]=User::whereNotIn("id",[ $boardUsers])->get();
      
        

        return response()->json(['data' => $data]);
    }
}
