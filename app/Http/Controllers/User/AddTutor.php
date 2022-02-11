<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\InputTutorRequest;
use App\Models\Auth\User;
use App\Models\Account\User as UserAccount;
use App\Models\Auth\Roles;

class AddTutor extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('admin')->only('inputTutor');

    }

    public function inputTutor(InputTutorRequest $request)
    {
        $user =  auth()->user()->profile->roles->has_roles->name;

        $authTutor = User::create([
            'email'  => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $authTutor->profile()->create($request->except(['password']));

        $inputRoles = Roles::create([
            'user_id'=> $authTutor->profile->id,
            'role_id'=> $request->role_id
        ]);

        return $this->handleResponse(200, 'success');

    }

    public function authme()
    {
        $result = auth()->user()->load('profile.city.province','profile.roles.has_roles');

        return  $this->handleResponse(200, 'success', $result);
    }
}
