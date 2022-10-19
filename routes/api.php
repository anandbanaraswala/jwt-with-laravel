<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jwt;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[App\Http\Controllers\jwt::class,'login']);
Route::post('register',[App\Http\Controllers\jwt::class,'register']);

Route::group(["middleware" => ["auth:api"]], function(){
    Route::post('user-course-enrollment',[App\Http\Controllers\jwt::class,'course_insert']);
    Route::get('get-users-profile',[App\Http\Controllers\jwt::class,'get_users']);
    Route::get("logout", [App\Http\Controllers\jwt::class, "logout"]);
    Route::get('get-total_courses',[App\Http\Controllers\jwt::class,'get_courses']);
    Route::get('delete-user-courses/{id}',[App\Http\Controllers\jwt::class,'delete_courses']);
});
