<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    //all users or single user
    public function userGet($id=null)
    {
        if ($id=='') {
            $users = User::get();
            return response()->json(['users'=>$users],200);
        }
        else
        {
            $user = User::find($id);
            return response()->json(['user'=>$user],200);
        }
    }

    // add user
    public function addUser(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ];
        $message = [
            'name.required' => 'Enter the name',

            'email.required' => 'Email is required',
            'email.email' => 'Enter the valid Email Account',
            'email.unique' => 'Already has an account select UNIQUE one',

            'password.required' => 'Enter the Password'
        ];

        $validator = Validator::make($data,$rules,$message);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        if($request->isMethod('post')){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =bcrypt($request->password);
            $user->save();
            $msg = 'User added successfully';
            return response()->json(['message'=>$msg]);
        }
    }
}
