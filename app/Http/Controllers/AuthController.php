<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Account\User;
use App\Models\Auth\User as Auth;
use DB;
use Str;

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
        $dataUser = $request->except(['password','role','password_confirmation']);

        $dataUser['verification_code'] = \Str::random(55);

        $email = $request->email;

        $password = $request->get('password');

        $role = $request->get('role');

        DB::beginTransaction();
        try {
            $userAuth = Auth::create(['email'=> $email,'password'=> bcrypt($password)]);

            $dataUser['auth_id'] = $userAuth->id;

            $user = User::create($dataUser);

            if($role == 1){
                $user->credit()->create(['user_id'=>$user->id,'credit_score'=>0]);
            }else if($role == 2){
                $user->credit()->create(['user_id'=>$user->id,'credit_score'=>40]);
            }else if($role == 2){
                $user->credit()->create(['user_id'=>$user->id,'credit_score'=>20]);
            }

            $userAuth->roles()->create(['user_id' => $userAuth->id, 'role_id' => $role ]);


        DB::commit();

        return response()->json([
            'message'=> 'User successfully registered',
            'user' => $dataUser,
        ], 201);
    } catch (\Exception $e) {
        DB::rollback();

        return $e->getMessage();
    }


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
