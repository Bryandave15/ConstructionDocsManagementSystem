<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InspectionController;

//form modules
//display of form
Route::get('/inspection', [InspectionController::class, 'index'])->name('inspection_Index');
//route that loads the form
Route::get('/inspection-add-form', [InspectionController::class, 'inspectionAddForm'])->name('inspection_Add_Form');
//route that recieves data from form
Route::post('/inspection-save', [InspectionController::class, 'inspectionSave'])->name('inspection_Save');
Route::get('/inspection-update-form/{inspection_id}', [InspectionController::class, 'inspectionUpdateForm'])->name('inspection_Update_Form');
Route::post('/inspection-update', [InspectionController::class, 'inspectionUpdate'])->name('inspection_Update');
Route::post('/inspection-del', [InspectionController::class, 'inspectionDelete'])->name('inspection_Delete');
