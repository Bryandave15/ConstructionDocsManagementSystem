<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Report; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Helpers\Fruits;

class ReportController extends Controller
{



    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated

    }

    //read, selections of fields
    public function index()
    {
       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $report_data = Report::where('status', 1)->orderBy('report_id', 'DESC')->get(); //display the active
        return view('report.index', compact('report_data'));
    }

    public function reportAddForm()
    {  //renders the form
       return view('report.report-add-form');
    }

    //recieved the form
    public function reportSave(Request $request)
    {
        $request->validate([
            'report_title' => 'required|string|max:150',
            'report_type' => 'required|string|max:100',
            'description' => 'required|string|max:100',
            'created_by' => 'required|string|max:50',
            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
        ]);

        $file = $request->file('attachment');
        $filename = time().'_'.$file->getClientOriginalName();
        //$file->storeAs('uploads', $filename, 'public');
        $file->move(public_path().'/uploads/', $filename);

       //saving process
       $okSaved = Report::create([
            'report_title' => $request->report_title,
            'report_type' => $request->report_type,
            'description' => $request->description,
            'created_by' => $request->created_by,
            'attachment' => $filename,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/report")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/report-add-form")->with('message','There is an error encountered in the saving process');
        }
    }

    public function reportUpdateForm(Request $request)
    {
        $reportFound = Report::where('report_id', $request->report_id)->first();
        
        if ($reportFound)
        {
            return view('report.report-edit-form', compact('reportFound'));

        } else {
            $errorMessage = "report ID invalid";
            return view('errors.index', compact('errorMessage'));
        }
        
    }

public function reportUpdate(Request $request)
{
    $request->validate([
            'report_title' => 'string|max:150',
            'report_type' => 'string|max:100',
            'description' => 'string|max:100',
            'created_by' => 'string|max:100',
            'attachment.*' => 'file|mimes:jpeg,png,pdf,gif'
    ]);
   
    $report = Report::find($request->report_id);
    
    if ($report) {
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = Auth::user()->id . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $filename);
            $report->attachment = $filename;
        }
        
        $report->report_title = $request->report_title;
        $report->report_type = $request->report_type;
        $report->description = $request->description;
        $report->created_by = $request->created_by;
  
        
        $okSaved = $report->save();
        // echo'this good 123';
        // exit;
        if ($okSaved) {
            return redirect("/report")->withSuccess('Product has been successfully updated');
        } else {
            return redirect("/report")->with('message', 'Error during the updating process');
        }
    } else {
        $errorMessage = "Product ID invalid";
        return view('errors.index', compact('errorMessage'));
    }
}


public function reportDelete(Request $request)
{
    if ($request->ajax()) { 
        $report = Report::find($request->report_id);  
        if ($report) {
            $report->delete(); // Delete the record from the database
            return response()->json(['success' => true]); // Return a success response
        } else {
            return response()->json(['success' => false, 'message' => 'Structural record not found']); // Return an error response
        }
    } else {
        abort(404); // If the request is not AJAX, return a 404 error
    }
}
}