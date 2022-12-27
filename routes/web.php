<?php

use App\Http\Controllers\User62Controller;
use App\Http\Controllers\Agama62Controller;
use App\Http\Controllers\Admin62Controller;
use App\Http\Controllers\apiclient\Agama62Controller as ClientAgama62Controller;
use App\Http\Controllers\apiclient\User62Controller as ClientUser62Controller;
use Illuminate\Support\Facades\Route;

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

//welcome page
Route::get('/', function () {
    return redirect('/login62');
});

Route::group(['middleware' => ['isNotLogin']], function () {
    // Register Login
    Route::view('/register62', 'register');
    Route::view('/login62', 'login');
    Route::post('/register62', [App\Http\Controllers\Register62Controller::class, 'register62']);
    Route::post('/login62', [App\Http\Controllers\Login62Controller::class, 'login62']);
});

// Role Admin
Route::group(['middleware' => ['isAdmin']], function () {

    // API DATA USER
    Route::get('/dashboard62', [User62Controller::class, 'dashboardPage62']);
    Route::get('/user62/{id}', [User62Controller::class, 'detailPage62']);
    Route::get('/user62/{id}/status', [User62Controller::class, 'putUserStatus62']);
    Route::post('/user62/{id}/agama', [User62Controller::class, 'putUserAgama62']);
    Route::get('/user62/{id}/delete', [Admin62Controller::class, "deleteUser62"]);

    // API AGAMA
    Route::get("/agama62", [Agama62Controller::class, "agamaPage62"]);
    Route::post("/agama62", [Agama62Controller::class, "createAgama62"]);
    Route::get("/agama62/{id}/edit", [Agama62Controller::class, "editAgamaPage62"]);
    Route::post("/agama62/{id}/update", [Agama62Controller::class, "updateAgama62"]);
    Route::get("/agama62/{id}/delete", [Agama62Controller::class, "deleteAgama62"]);

    // API CLIENT DATA USER
    Route::get("/apiclient/dashboard62", [ClientUser62Controller::class, "dashboardPage62"]);
    Route::get("/apiclient/user62/{id}", [ClientUser62Controller::class, "detailPage62"]);
    Route::get("/apiclient/user62/{id}/status", [ClientUser62Controller::class, "putUserStatus62"]);
    Route::post("/apiclient/user62/{id}/agama", [ClientUser62Controller::class, "putUserAgama62"]);
    Route::get("/apiclient/user62/{id}/delete", [ClientUser62Controller::class, "deleteUser62"]);

    // API CLIENT AGAMA
    Route::get("/apiclient/agama62", [ClientAgama62Controller::class, "agamaPage62"]);
    Route::get("/apiclient/agama62/{id}/edit", [ClientAgama62Controller::class, "editAgamaPage62"]);
    Route::post("/apiclient/agama62", [ClientAgama62Controller::class, "createAgama62"]);
    Route::post("/apiclient/agama62/{id}/update", [ClientAgama62Controller::class, "updateAgama62"]);
    Route::get("/apiclient/agama62/{id}/delete", [ClientAgama62Controller::class, "deleteAgama62"]);


});


// Role User
Route::group(['middleware' => ['isUser']], function () {

    // API User
    Route::view('/changePassword62', 'editPW');
    Route::get('/profile62', [User62Controller::class, 'profilePage62']);
    Route::post('/user62', [User62Controller::class, 'putUserDetail62']);
    Route::post('/user62/photo', [User62Controller::class, 'putUserPhoto62']);
    Route::post('/user62/photoKTP', [User62Controller::class, 'putUserPhotoKTP62']);
    Route::post('/user62/password', [User62Controller::class, 'putUserPassword62']);

    // API Client User
    Route::view('/apiclient/changePassword62', 'editPW', ['Use_API' => true]);
    Route::get('/apiclient/profile62', [ClientUser62Controller::class, 'profilePage62']);
    Route::post('/apiclient/user62', [ClientUser62Controller::class, 'putUserDetail62']);
    Route::post('/apiclient/user62/photo', [ClientUser62Controller::class, 'putUserPhoto62']);
    Route::post('/apiclient/user62/photoKTP', [ClientUser62Controller::class, 'putUserPhotoKTP62']);
    Route::post('/apiclient/user62/password', [ClientUser62Controller::class, 'putUserPassword62']);


});

// Welcome Page
Route::get('/halo62', [App\Http\Controllers\Halo62Controller::class, 'halo62']);

// Logout Session
Route::get('/logout62', [User62Controller::class, 'logout62'])->middleware('isLogin');
