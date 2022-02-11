<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\InputKosRequest;
use Illuminate\Http\Request;
use App\Models\Account\User;
use App\Models\Kos\Boarding;

class ManagemenKos extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('admin')->only('inputKos');

    }

    public function inputKos(InputKosRequest $request)
    {

        Boarding::create($request->all);

        return $this->handleResponse(200, 'success');

    }

    public function authme()
    {
        $result = auth()->user()->load('profile.city.province','auth_user.roles');

        return  $this->handleResponse(200, 'success', $result);
    }
}
