<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Question\ManageQuestion;
use App\Http\Controllers\Question\SearchQuestion;
use App\Http\Controllers\User\AddTutor;

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
    Route::post('inputQuestion', [ManageQuestion::class, 'inputQuestion']);
    Route::put('editQuestion/{id}', [ManageQuestion::class, 'editQuestion']);
    Route::get('question', [ManageQuestion::class, 'getQuestion']);
    Route::post('search', [SearchQuestion::class, 'searchQuestion']);
    Route::post('searchbycategory', [SearchQuestion::class, 'searchQuestionByCategory']);
    Route::delete('deletequestion/{id}', [ManageQuestion::class, 'deleteQuestion']);
    Route::get('authme',[AddTutor::class, 'authme']);
});
Route::group(['middleware' => ['api','admin'], 'prefix'=> 'auth'], function ($router) {
    Route::post('inputTutor', [AddTutor::class, 'inputTutor']);
});
