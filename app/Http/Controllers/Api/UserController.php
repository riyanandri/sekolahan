<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        return success($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:admin,guru',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            $msg = $validator->errors();

            return failedResponse($msg, 422);
        }

        $user = new User();
        $user->type = $request->type;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $saveUser = $user->save();
        if ($saveUser) {
            return success($user, 201);
        } else {
            return failedResponse('User gagal ditambahkan!', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return success($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:admin,guru',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            $msg = $validator->errors();

            return failedResponse($msg, 422);
        }

        $user->type = $request->type;
        $user->username = $request->username;
        if ($request->has('password')) {
            $user->password = $request->password ? Hash::make($request->password) : $user->password;
        }
        $saved = $user->save();

        if ($saved) {
            return success($user, 200);
        } else {
            return failedResponse('User gagal diupdate!', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleteData = $user->delete();

        if ($deleteData) {
            return success(null, 200);
        } else {
            return failedResponse('User gagal dihapus!', 500);
        }
    }
}
