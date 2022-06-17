<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//get user api
Route::get('/user/{id?}', [UserApiController::class, 'userGet']);
//Post Method
Route::post('/add-user',[UserApiController::class,'addUser']);
//Add multiplae user
Route::post('/add-multi-data',[UserApiController::class,'addMultiUser']);
