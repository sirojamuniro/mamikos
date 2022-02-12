<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ManagemenKos;
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
    Route::put('editQuestion/{id}', [ManageQuestion::class, 'editQuestion']);
    Route::get('question', [ManageQuestion::class, 'getQuestion']);
    Route::post('search', [ManagemenKos::class, 'searchKos']);
    Route::post('searchbycategory', [SearchQuestion::class, 'searchQuestionByCategory']);
    Route::delete('deletequestion/{id}', [ManageQuestion::class, 'deleteQuestion']);
    Route::get('authme',[ManagemenKos::class, 'authme']);
});
Route::group(['middleware' => ['api','admin'], 'prefix'=> 'auth'], function ($router) {
    Route::post('input-kos', [ManagemenKos::class, 'inputKos']);
    Route::put('update-kos/{id}', [ManagemenKos::class, 'updateKos']);
    Route::delete('delete-kos/{id}', [ManagemenKos::class, 'deleteKos']);
    Route::get('my-kos', [ManagemenKos::class, 'myKos']);
});
