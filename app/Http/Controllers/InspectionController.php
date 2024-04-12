<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inspection; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class InspectionController extends Controller
{

    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated

    }

    //read, selections of fields
    public function index()
    {
       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $inspection_data = Inspection::where('status', 1)->orderBy('inspection_id', 'DESC')->get(); //display the active
        return view('inspection.index', compact('inspection_data'));
    }

    public function inspectionAddForm()
    {  //renders the form
       return view('inspection.inspection-add-form');
    }

    //recieved the form
    public function inspectionSave(Request $request)
    {
        $request->validate([
            'inspection_title' => 'required|string|max:150',
            'inspection_code' => 'required|string|max:150',
            'inspection_type' => 'required|string|max:100',
            'inspection_category' => 'required|string|max:100',
            'inspection_date' => 'required|string|max:100',
            'description' => 'required|string|max:100',
            'remarks' => 'required|string|max:100',

            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
        ]);

        $file = $request->file('attachment');
        $filename = time().'_'.$file->getClientOriginalName();
        //$file->storeAs('uploads', $filename, 'public');
        $file->move(public_path().'/uploads/', $filename);

       //saving process
       $okSaved = Inspection::create([
            'inspection_title' => $request->inspection_title,
            'inspection_code' => $request->inspection_code,
            'inspection_type' => $request->inspection_type,
            'inspection_category' => $request->inspection_category,
            'inspection_date' => $request->inspection_date,
            'description' => $request->description,
            'remarks' => $request->remarks,
            'attachment' => $filename,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/inspection")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/inspection-add-form")->with('message','There is an error encountered in the saving process');
        }
    }

    public function inspectionUpdateForm(Request $request)
    {
        $inspectionFound = Inspection::where('inspection_id', $request->inspection_id)->first();
        
        if ($inspectionFound)
        {
            return view('inspection.inspection-edit-form', compact('inspectionFound'));

        } else {
            $errorMessage = "form ID invalid";
            return view('errors.index', compact('errorMessage'));
        }
        echo'this good';
    }

public function inspectionUpdate(Request $request)
{
    $request->validate([
            'inspection_title' => 'string|max:150',
            'inspection_code' => 'string|max:150',
            'inspection_type' => 'string|max:100',
            'inspection_category' => 'string|max:100',
            'inspection_date' => 'string|max:100',
            'description' => 'string|max:100',
            'remarks' => 'string|max:100',

            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
    ]);
   
    $inspection = Inspection::find($request->inspection_id);
    
    if ($inspection) {
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = Auth::user()->id . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $filename);
            $inspection->attachment = $filename;
        }
        
        $inspection->inspection_title = $request->inspection_title;
        $inspection->inspection_code = $request->inspection_code;
        $inspection->inspection_type = $request->inspection_type;
        $inspection->inspection_category = $request->inspection_category;
        $inspection->inspection_date = $request->inspection_date;
        $inspection->description = $request->description;
        $inspection->remarks = $request->remarks;
        // return redirect("/form")->withSuccess('Product has been successfully updated');
        // $structural->attachment = $request->attachment;
        
        $okSaved = $inspection->save();
        // echo'this good 123';
        // exit;
        if ($okSaved) {
            return redirect("/inspection")->withSuccess('Product has been successfully updated');
        } else {
            return redirect("/inspection")->with('message', 'Error during the updating process');
        }
    } else {
        $errorMessage = "Product ID invalid";
        return view('errors.index', compact('errorMessage'));
    }
}


public function inspectionDelete(Request $request)
{
    if ($request->ajax()) { 
        $inspection = Inspection::find($request->inspection_id);  
        if ($inspection) {
            $inspection->delete(); // Delete the record from the database
            return response()->json(['success' => true]); // Return a success response
        } else {
            return response()->json(['success' => false, 'message' => 'meeting record not found']); // Return an error response
        }
    } else {
        abort(404); // If the request is not AJAX, return a 404 error
    }
}
}