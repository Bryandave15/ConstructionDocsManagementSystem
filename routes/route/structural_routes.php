<?php

// routes/structural_routes.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StructuralController;

//form modules
//display of form
Route::get('/structural', [StructuralController::class, 'index'])->name('structural_Index');
//route that loads the form
Route::get('/structural-add-form', [StructuralController::class, 'structuralAddForm'])->name('structural_Add_Form');
//route that recieves data from form
Route::post('/structural-save', [StructuralController::class, 'structuralSave'])->name('structural_Save');
Route::get('/structural-update-form/{structural_id}', [StructuralController::class, 'structuralUpdateForm'])->name('structural_Update_Form');
Route::post('/structural-update', [StructuralController::class, 'structuralUpdate'])->name('structural_Update');
Route::post('/structural-del', [StructuralController::class, 'structuralDelete'])->name('structural_Delete');
Route::get('/structural-select/{structural_id}', [StructuralController::class, 'structuralSelectOne'])->name('structural_Select');