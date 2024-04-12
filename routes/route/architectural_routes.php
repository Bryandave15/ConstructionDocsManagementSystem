<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchitecturalController;

//mefps modules
//display of mefps
Route::get('/architectural', [ArchitecturalController::class, 'index'])->name('architectural_Index');
//route that loads the form
Route::get('/architectural-add-form', [ArchitecturalController::class, 'architecturalAddForm'])->name('architectural_Add_Form');
//route that recieves data from form
Route::post('/architectural-save', [ArchitecturalController::class, 'architecturalSave'])->name('architectural_Save');
Route::get('/architectural-update-form/{architectural_id}', [ArchitecturalController::class, 'architecturalUpdateForm'])->name('architectural_Update_Form');
Route::post('/architectural-update', [ArchitecturalController::class, 'architecturalUpdate'])->name('architectural_Update');
Route::post('/architectural-del', [ArchitecturalController::class, 'architecturalDelete'])->name('architectural_Delete');