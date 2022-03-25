<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BoardController;
use App\Http\Controllers\Api\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Auth routes
Route::post("register",[UserController::class,"signUp"]);
Route::post("login",[UserController::class,"login"]);

Route::middleware(['auth:api'])->group(function () {

    //Board APIs
    Route::post("add-board",[BoardController::class,"insert"]);
    Route::post("add-board-member",[BoardController::class,"addMember"]);
    Route::post("remove-board-member",[BoardController::class,"removeMember"]);

    //Task API's
    Route::post("add-task",[TaskController::class,"insert"]);
    Route::post("update-task",[TaskController::class,"update"]);
    Route::post("delete-task",[TaskController::class,"delete"]);
    Route::post("relocate-task",[TaskController::class,"relocate"]);
    Route::post("assign-task",[TaskController::class,"assign"]);
    Route::post("add-label-task",[TaskController::class,"addLabel"]);

    //Search API 
    Route::get("search/{id}",[TaskController::class,"searchQuery"]);

});