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
Route::post('/add-user', [UserApiController::class, 'addUser']);
//Add multiplae user
Route::post('/add-multi-data', [UserApiController::class, 'addMultiUser']);
//put method for upate user
Route::put('/user-update/{id}', [UserApiController::class, 'updateUser']);
//patch api update single record
Route::patch('/update-single/{id}', [UserApiController::class, 'updateSingle']);
//delete data
Route::delete('/delete-data/{id?}', [UserApiController::class, 'deleteData']);

