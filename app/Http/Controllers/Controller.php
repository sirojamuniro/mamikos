<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function handleResponse($httpStatus = 200, $message = 'success', $data = null)
    {
    	$response = [
    		'status' => $httpStatus == 200 ? true : false,
    		'message' => $message,
    		'data' => $data
    	];

    	return response()->json($response, $httpStatus);
    }
}
