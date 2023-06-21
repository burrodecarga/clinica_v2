<?php

use App\Http\Controllers\Services\MedicineController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('services.index');
})->middleware('can:services.index')->name('services.index');

Route::resource('/medicines', MedicineController::class)->names('medicines');
