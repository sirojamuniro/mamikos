<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\InputKosRequest;
use Illuminate\Http\Request;
use App\Models\Account\User;
use App\Models\Kos\Boarding;

class ManagemenKosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('admin')->only(['inputKos','updateKos','deleteKos','myKos']);

    }

    public function inputKos(InputKosRequest $request)
    {
        $boarding = $request->except('user_id');
        $boarding['user_id'] = auth()->user()->profile->id;


        Boarding::create($boarding);

        return $this->handleResponse(200, 'success');

    }

    public function authme()
    {
        $result = auth()->user()->load('profile.city.province','roles.has_roles');

        return  $this->handleResponse(200, 'success', $result);
    }


    public function updateKos(InputKosRequest $request,$id)
    {
        $boarding = $request->except('user_id');
        $boarding['user_id'] = auth()->user()->profile->id;

        Boarding::where('id',$id)->update($boarding);

        return $this->handleResponse(200, 'success');

    }

    public function deleteKos($id)
    {
        Boarding::where('id',$id)->delete();

        return $this->handleResponse(200, 'success');

    }

    public function myKos()
    {
        $result = auth()->user()->profile->load(['boarding','boarding.city','boarding.province']);

        return $this->handleResponse(200, 'success',$result);

    }

    public function searchKos(Request $request)
    {
       $name = $request->name;
       $city = $request->city_id;
       $province = $request->province_id;
       $price = $request->price;

       $sort = $request->sort;

       $priceSort = $sort != "" ? $sort : "asc";
        if($name){
        $result = Boarding::where('name','like','%' . $name . '%');

        }
        if($city){
            $result = $result->where('city_id', $city);
        }
        if($province){
            $result = $result->where('province_id', $province );

        }
        if($price){

            $range= explode(":", $price);
            // var_dump($range);
            if(count($range) > 1){
            $priceStart=(int) $range[0];
            $priceEnd=(int) $range[1];
            $result = $result->whereBetween('price',[$priceStart,$priceEnd]);
            }
            else
            {
            $priceStart=(int) $range[0];

            $result = $result->where('price',$priceStart);
            }
        }
        $result = $result->with(['user','city','province'])->orderBy('price',$priceSort)->get();

        return $this->handleResponse(200, 'success',$result);

    }
}
