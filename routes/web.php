<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
//});

Route::get('/', function () {
    if(auth()->user()){
if (User::role(['admin', 'doctor', 'pharmacist'])) {return redirect('redirects');}

    }
    $doctors = User::role('doctor')->orderBy('name')->get();
    $specialties = Specialty::orderBy('name')->get();
    //$doctors=[];
    return view('welcome',compact('doctors','specialties'));
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth:sanctum', 'verified'])->get('redirects', [HomeController::class,'index']);

Route::get('/json', function () {
$cie10_1 = DB::table('cie10_1')->get();
return $cie10_1;
});

Route::get('/enfermedades', function () {
return datatables(DB::table('pathologies'))
->addColumn('btn','livewire.doctor.actions')
->rawColumns(['btn'])
->toJson();
    })->name('pathologies.index');



Route::get('/info',[InfoController::class,'index'])->name('info');


