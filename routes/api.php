<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login',[AuthController::class,'login']);
Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::post('/logout',[AuthController::class,'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/specialties', function(){

    return Specialty::orderBy('name')->get();
});

Route::get('/doctors', function(){

    return User::role('doctor')->orderBy('name')->get();
});


Route::get('/users', function (Request $request){
    return datatables()->of(User::with('roles'))
    ->addColumn('btn','admin.users.actions')
    ->rawColumns(['btn'])
    ->toJson();
});
