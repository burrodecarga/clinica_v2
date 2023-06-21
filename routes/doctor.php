<?php

use App\Http\Controllers\Doctor\CurriculumController;
use App\Http\Controllers\Interwiews\InterviewController;
use App\Http\Livewire\Doctor\AntecedentController;

use App\Http\Livewire\Doctor\OfficeController;
use App\Http\Livewire\Doctor\WorkdayController;
use App\Http\Livewire\Doctor\DisaseController;
use App\Http\Livewire\Doctor\HabitController;

use App\Http\Livewire\Doctor\SurgeryController;
use App\Http\Livewire\Doctor\SymptomController;

use App\Http\Livewire\Doctor\VerifyController;
use App\Http\Livewire\Doctor\Enfermedades;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
       return view('doctor.index');
})->middleware('can:doctor.index')->name('doctor.index');


Route::middleware('can:offices.index')->get('/offices',OfficeController::class)->name('offices.index');

Route::middleware('role:doctor')->get('/workdays',WorkdayController::class)->name('workdays.index');

Route::middleware('role:doctor')->get('/curriculum',[CurriculumController::class,'index'])->name('curriculum.index');

Route::middleware('role:doctor')->get('/interviews/{user}',[InterviewController::class,'index'])->name('interviews.index');

Route::middleware('role:doctor')->put('/interviews/{user}/update', [InterviewController::class, 'patientUpdate'])->name('interviews.patient-update');

Route::middleware('role:doctor')->get('/interviews/detail/{interview}',[InterviewController::class,'detail'])->name('interviews.detail');

Route::middleware('role:doctor')->get('/interviews/{user}/create', [InterviewController::class, 'create'])->name('interviews.create');

Route::middleware('role:doctor')->get('/interviews/{ficha}/ficha', [InterviewController::class, 'ficha'])->name('interviews.ficha');


Route::middleware('role:doctor')->get('/disases',Enfermedades::class)->name('disases.index');

Route::middleware('role:doctor')->get('/surgeries', SurgeryController::class)->name('surgeries.index');

Route::middleware('role:doctor')->get('/antecedents', AntecedentController::class)->name('antecedents.index');

Route::middleware('role:doctor')->get('/habits', HabitController::class)->name('habits.index');

Route::middleware('role:doctor')->get('/symptoms', SymptomController::class)->name('symptoms.index');


Route::middleware('role:doctor')->get('/verifies', VerifyController::class)->name('verify.index');









