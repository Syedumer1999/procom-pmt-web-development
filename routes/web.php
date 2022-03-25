
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BoardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/",[AuthController::class,"login"])->name("login");
Route::get("register",[AuthController::class,"register"])->name("register");
Route::post("register",[UserController::class,"signUp"]);
Route::post("do-login",[AuthController::class,"doLogin"]);

Route::get("assign-task/{task_id}/{assignMember?}/{assignLabel?}",[TaskController::class,"assign"]);

Route::middleware(['auth'])->group(function () {
    Route::get("logout",[AuthController::class,"logout"])->name("logout");
    Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");
    Route::get("/get-data/{id}",[DashboardController::class,"getBoardData"]);
    Route::get("relocate/{id}/{list_id}",[DashboardController::class,"relocate"]);

    Route::post("add-task",[TaskController::class,"insert"]);
    Route::post("add-update",[TaskController::class,"addUpdate"]);
    Route::get("get-task/{id}",[TaskController::class,"getTask"]);
    Route::get("board/{id}",[DashboardController::class,"selectBoard"]);
    Route::post("set-time",[BoardController::class,"setTime"]);

    

    
    Route::post("add-board",[BoardController::class,"insert"]);
    
    Route::post("add-member",[BoardController::class,"addMember"]);
});