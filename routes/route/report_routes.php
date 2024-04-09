<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

//report modules
//display of report
Route::get('/report', [ReportController::class, 'index'])->name('report_Index');
//route that loads the form
Route::get('/report-add-form', [ReportController::class, 'reportAddForm'])->name('report_Add_Form');
//route that recieves data from form
Route::post('/report-save', [ReportController::class, 'reportSave'])->name('report_Save');
Route::get('/report-update-form/{report_id}', [ReportController::class, 'reportUpdateForm'])->name('report_Update_Form');
Route::post('/report-update', [ReportController::class, 'reportUpdate'])->name('report_Update');
Route::post('/report-del', [ReportController::class, 'reportDelete'])->name('report_Delete');