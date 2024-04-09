<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;

//meeting modules
//display of meeting
Route::get('/meeting', [MeetingController::class, 'index'])->name('meeting_Index');
//route that loads the form
Route::get('/meeting-add-form', [MeetingController::class, 'meetingAddForm'])->name('meeting_Add_Form');
//route that recieves data from form
Route::post('/meeting-save', [MeetingController::class, 'meetingSave'])->name('meeting_Save');
Route::get('/meeting-update-form/{meeting_id}', [MeetingController::class, 'meetingUpdateForm'])->name('meeting_Update_Form');
Route::post('/meeting-update', [MeetingController::class, 'meetingUpdate'])->name('meeting_Update');
Route::post('/meeting-del', [MeetingController::class, 'meetingDelete'])->name('meeting_Delete');