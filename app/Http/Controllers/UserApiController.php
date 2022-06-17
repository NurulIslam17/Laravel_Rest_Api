<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserApiController extends Controller
{
    //all users or single user
    // public function userGet($id=null)
    // {
    //     if ($id=='') {
    //         $users = User::get();
    //         return response()->json(['users'=>$users],200);
    //     }
    //     else
    //     {
    //         $user = User::find($id);
    //         return response()->json(['user'=>$user],200);
    //     }
    // }
}
