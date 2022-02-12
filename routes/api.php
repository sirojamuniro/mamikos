<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ManagemenKosController;
use App\Http\Controllers\Question\SearchQuestion;
use App\Http\Controllers\User\ChatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix'=> 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('question', [ManageQuestion::class, 'getQuestion']);
    Route::post('search', [ManagemenKosController::class, 'searchKos']);
    Route::get('authme',[ManagemenKosController::class, 'authme']);
});
Route::group(['middleware' => ['api','owner'], 'prefix'=> 'auth'], function ($router) {
    Route::post('input-kos', [ManagemenKosController::class, 'inputKos']);
    Route::put('update-kos/{id}', [ManagemenKosController::class, 'updateKos']);
    Route::delete('delete-kos/{id}', [ManagemenKosController::class, 'deleteKos']);
    Route::get('my-kos', [ManagemenKosController::class, 'myKos']);
});

Route::group(['middleware' => ['api'], 'prefix'=> 'message'], function ($router) {
    Route::post('', [ChatController::class, 'sendMessage']);
    Route::get('/{id}', [ChatController::class, 'getMessage']);

});
