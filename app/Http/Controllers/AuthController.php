<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Account\User;
use DB;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        if(! $token = auth()->attempt($request->validated()))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return 'success';
    }

    public function register(RegistrationRequest $request)
    {
        $dataUser = $request->except('password');

        $dataUser['verification_code'] = \Str::random(55);

        $password = $request->get('password');

        DB::transaction(function () use ($dataUser, $password)
        {
            $user = User::create($dataUser);

            $user->auth_user()->create(['password'=> bcrypt($password)]);

        });

        return response()->json([
            'message'=> 'User successfully registered',
            'user' => $dataUser
        ], 201);
    }

    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=> auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->profile
        ]);

    }

}
