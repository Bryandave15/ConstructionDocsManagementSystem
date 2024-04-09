<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MefpsController;

//mefps modules
//display of mefps
Route::get('/mefps', [MefpsController::class, 'index'])->name('mefps_Index');
//route that loads the form
Route::get('/mefps-add-form', [MefpsController::class, 'mefpsAddForm'])->name('mefps_Add_Form');
//route that recieves data from form
Route::post('/mefps-save', [MefpsController::class, 'mefpsSave'])->name('mefps_Save');
Route::get('/mefps-update-form/{mefps_id}', [MefpsController::class, 'mefpsUpdateForm'])->name('mefps_Update_Form');
Route::post('/mefps-update', [MefpsController::class, 'mefpsUpdate'])->name('mefps_Update');
Route::post('/mefps-del', [MefpsController::class, 'mefpsDelete'])->name('mefps_Delete');