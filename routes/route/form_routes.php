<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

//form modules
//display of form
Route::get('/form', [FormController::class, 'index'])->name('form_Index');
//route that loads the form
Route::get('/form-add-form', [FormController::class, 'formAddForm'])->name('form_Add_Form');
//route that recieves data from form
Route::post('/form-save', [FormController::class, 'formSave'])->name('form_Save');
Route::get('/form-update-form/{form_id}', [FormController::class, 'formUpdateForm'])->name('form_Update_Form');
Route::post('/form-update', [FormController::class, 'formUpdate'])->name('form_Update');
Route::post('/form-del', [FormController::class, 'formDelete'])->name('form_Delete');
Route::get('/structural-select/{structural_id}', [FormController::class, 'structuralSelectOne'])->name('structural_Select');