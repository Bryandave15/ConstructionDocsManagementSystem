<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectoryController;

//form modules
//display of form
Route::get('/directory', [DirectoryController::class, 'index'])->name('form_Index');
//route that loads the form
Route::get('/directory-add-form', [DirectoryController::class, 'directoryAddForm'])->name('directory_Add_Form');
//route that recieves data from form
Route::post('/directory-save', [DirectoryController::class, 'directorySave'])->name('directory_Save');
Route::get('/directory-update-form/{directory_id}', [DirectoryController::class, 'directoryUpdateForm'])->name('directory_Update_Form');
Route::post('/diretory-update', [DirectoryController::class, 'diretoryUpdate'])->name('directory_Update');
Route::post('/directory-del', [DirectoryController::class, 'directoryDelete'])->name('directory_Delete');

Route::get('/directory-select/{directory_id}', [DirectoryController::class, 'directorySelectOne'])->name('directory_Select');
//search
Route::post('/directory-search', [DirectoryController::class, 'directorySearch'])->name('directory_Search');

//search
Route::post('/product-search', [ProductController::class, 'productSearch'])->name('product_Search');