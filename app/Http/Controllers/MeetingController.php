<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meeting; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class MeetingController extends Controller
{

    public $sample1;  //example of a property

    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated

    }

    //read, selections of fields
    public function index()
    {
       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $meeting_data = Meeting::where('status', 1)->orderBy('meeting_id', 'DESC')->get(); //display the active
        return view('meeting.index', compact('meeting_data'));
    }

    public function meetingAddForm()
    {  //renders the form
       return view('meeting.meeting-add-form');
    }

    //recieved the form
    public function meetingSave(Request $request)
    {
        $request->validate([
            'meeting_title' => 'required|string|max:150',
            'meeting_overview' => 'required|string|max:100',
            'meeting_location' => 'required|string|max:100',
            'meeting_agenda' => 'required|string|max:150',
            'minutes_meeting' => 'required|string|max:150',
            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
        ]);

        $file = $request->file('attachment');
        $filename = time().'_'.$file->getClientOriginalName();
        //$file->storeAs('uploads', $filename, 'public');
        $file->move(public_path().'/uploads/', $filename);

       //saving process
       $okSaved = Meeting::create([
            'meeting_title' => $request->meeting_title,
            'meeting_overview' => $request->meeting_overview,
            'meeting_location' => $request->meeting_location,
            'meeting_agenda' => $request->meeting_agenda,
            'minutes_meeting' => $request->minutes_meeting,
            'attachment' => $filename,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/meeting")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/meeting-add-form")->with('message','There is an error encountered in the saving process');
        }
    }

    public function meetingUpdateForm(Request $request)
    {
        $meetingFound = Meeting::where('meeting_id', $request->meeting_id)->first();
        
        if ($meetingFound)
        {
            return view('meeting.meeting-edit-form', compact('meetingFound'));

        } else {
            $errorMessage = "Structural ID invalid";
            return view('errors.index', compact('errorMessage'));
        }
        echo'this good';
    }

public function meetingUpdate(Request $request)
{
    $request->validate([
        'meeting_title' => 'string|max:150',
        'meeting_overview' => 'string|max:100',
        'meeting_date' => 'string|max:150',
        'meeting_location' => 'string|max:100',
        'meeting_agenda' => 'string|max:150',
        'minutes_meeting' => 'string|max:150',
        'attachment.*' => 'file|mimes:jpeg,png,pdf,gif'
    ]);
   
    $meeting = Meeting::find($request->meeting_id);
    
    if ($meeting) {
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = Auth::user()->id . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $filename);
            $meeting->attachment = $filename;
        }
        
        $meeting->meeting_title = $request->meeting_title;
        $meeting->meeting_overview = $request->meeting_overview;
        $meeting->meeting_date = $request->meeting_date;
        $meeting->meeting_location = $request->meeting_location;
        $meeting->meeting_agenda = $request->meeting_agenda;
        $meeting->minutes_meeting = $request->minutes_meeting;

        $okSaved = $meeting->save();
        // echo'this good 123';
        // exit;
        if ($okSaved) {
            return redirect("/meeting")->withSuccess('Product has been successfully updated');
        } else {
            return redirect("/meeting")->with('message', 'Error during the updating process');
        }
    } else {
        $errorMessage = "Product ID invalid";
        return view('errors.index', compact('errorMessage'));
    }
}


    public function meetingDelete(Request $request)
    {
        if ($request->ajax()) { 
            $meeting = Meeting::find($request->meeting_id);  
            if ($meeting) {
                $meeting->delete(); // Delete the record from the database
                return response()->json(['success' => true]); // Return a success response
            } else {
                return response()->json(['success' => false, 'message' => 'meeting record not found']); // Return an error response
            }
        } else {
            abort(404); // If the request is not AJAX, return a 404 error
        }
    }
}