<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    //all users or single user
    public function userGet($id = null)
    {
        if ($id == '') {
            $users = User::get();
            return response()->json(['users' => $users], 200);
        } else {
            $user = User::find($id);
            return response()->json(['user' => $user], 200);
        }
    }
    // add user
    public function addUser(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
        $message = [
            'name.required' => 'Enter the name',

            'email.required' => 'Email is required',
            'email.email' => 'Enter the valid Email Account',
            'email.unique' => 'Already has an account select UNIQUE one',

            'password.required' => 'Enter the Password'
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->isMethod('post')) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            $msg = 'User added successfully';
            return response()->json(['message' => $msg], 200);
        }
    }
    //add multi user
    public function addMultiUser(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();

            $rules = [
                'multiUser.*.name' => 'required',
                'multiUser.*.email' => 'required|email|unique:users',
                'multiUser.*.password' => 'required'
            ];

            $msgError = [
                'multiUser.*.name.required' => 'User name Required',
                'multiUser.*.email.required' => 'Email is Required',
                'multiUser.*.email.email' => 'Enter valid email',
                'multiUser.*.email.unique' => 'Use onother account name',
                'multiUser.*.password.required' => 'Enter the password'
            ];

            $validate = Validator($data, $rules, $msgError);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 422);
            }

            foreach ($data['multiUser'] as $mUser) {
                $user = new User();
                $user->name = $mUser['name'];
                $user->email = $mUser['email'];
                $user->password = bcrypt($mUser['password']); // bcrypt can be use
                $user->save();
            }
            $massage = 'Users added Successfully';
            return response()->json(['msg' => $massage], 201);
        }
    }
    //update user
    public function updateUser(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'password' => 'required'
            ];

            $errMsg = [
                'name.required' => 'Enter the name',
                'password.required' => 'Enter the password',
            ];

            $valid = Validator::make($data, $rules, $errMsg);
            if ($valid->fails()) {
                return response()->json($valid->errors(), 422);
            }

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->save();
            $update = 'User Updated Successfully.';
            return response()->json(['msg' => $update], 200);
        }
    }
    //update Single
    public function updateSingle(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            $data = $request->all();
            $rules = [
                'name' => 'required'
            ];
            $errMasg = [
                'name.required' => 'Enter the name'
            ];

            $validtor = Validator::make($data, $rules, $errMasg);

            if ($validtor->fails()) {
                return response()->json($validtor->errors(), 422);
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->save();
            $msg = 'Updated single data';
            return response()->json(['msg' => $msg], 200);
        }
    }
    //delete single Data
    public function deleteData(Request $request, $id = null)
    {
        $header = $request->header('AuthDelete'); // jwt authentication 
        if ($header == '') {
            $delMsg = 'Authentication required';
            return response()->json(['msg' => $delMsg], 422);
        } else {
            if ($header == 'eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6Ik51cnVsIElzbGFtIiwiaWF0IjoxNTE2MjM5MDIyfQ') {
                if ($id == '') {
                    $msg = 'Nothing to delete. Please select the ID';
                    return response()->json(['msg' => $msg], 200);
                } else {
                    $user = User::find($id);
                    $user->delete();
                    $delMsg = 'Data deleted successfully';
                    return response()->json(['msg' => $delMsg], 200);
                }
            } else {
                $delMsg = 'Authentication Does not Matched';
                return response()->json(['msg' => $delMsg], 200);
            }
        }
    }
}
