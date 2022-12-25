<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Agama62Controller;
use App\Http\Controllers\api\User62Controller;

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

Route::get("/user62", [User62Controller::class, "getUsers62"]);
Route::get("/user62/{id}", [User62Controller::class, "getUserDetail62"]);
Route::put("/user62/{id}", [User62Controller::class, "putUserDetail62"]);
Route::put("/user62/{id}/photo", [User62Controller::class, "putUserPhoto62"]);
Route::put("/user62/{id}/photoKTP", [User62Controller::class, "putUserPhotoKTP62"]);
Route::put("/user62/{id}/password", [User62Controller::class, "putUserPassword62"]);
Route::put("/user62/{id}/status", [User62Controller::class, "putUserStatus62"]);
Route::put("/user62/{id}/agama", [User62Controller::class, "putUserAgama62"]);
Route::delete("/user62/{id}", [User62Controller::class, "deleteUser62"]);

Route::get("/agama62", [Agama62Controller::class, "getAgama62"]);
Route::get("/agama62/{id}", [Agama62Controller::class, "getDetailAgama62"]);
Route::post("/agama62", [Agama62Controller::class, "postAgama62"]);
Route::put("/agama62/{id}", [Agama62Controller::class, "putAgama62"]);
Route::delete("/agama62/{id}", [Agama62Controller::class, "deleteAgama62"]);



