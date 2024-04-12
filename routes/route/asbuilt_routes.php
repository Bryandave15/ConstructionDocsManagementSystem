<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsbuiltController;

//mefps modules
//display of mefps
Route::get('/asbuilt', [AsbuiltController::class, 'index'])->name('asbuilt_Index');
//route that loads the form
Route::get('/asbuilt-add-form', [AsbuiltController::class, 'asbuiltAddForm'])->name('asbuilt_Add_Form');
//route that recieves data from form
Route::post('/asbuilt-save', [AsbuiltController::class, 'asbuiltSave'])->name('asbuilt_Save');
Route::get('/asbuilt-update-form/{asbuilt_id}', [AsbuiltController::class, 'asbuiltUpdateForm'])->name('asbuilt_Update_Form');
Route::post('/asbuilt-update', [AsbuiltController::class, 'asbuiltUpdate'])->name('asbuilt_Update');
Route::post('/asbuilt-del', [AsbuiltController::class, 'asbuiltDelete'])->name('asbuilt_Delete');