<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Architectural; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Helpers\Fruits;

class ArchitecturalController extends Controller
{
    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated
    }

    //read, selections of fields
    public function index()
    {
       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $architectural_data = Architectural::where('status', 1)->orderBy('architectural_id', 'DESC')->get(); //display the active
        return view('architectural.index', compact('architectural_data'));
    }

    public function architecturalAddForm()
    {  //renders the form
       return view('architectural.architectural-add-form');
    }

    //recieved the form
    public function architecturalSave(Request $request)
    {
        $request->validate([
            'architectural_title' => 'required|string|max:150',
            'architectural_code' => 'required|string|max:100',
            'architectural_location' => 'required|string|max:100',
            'trade' => 'required|string|max:100',
            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
        ]);

        $file = $request->file('attachment');
        $filename = time().'_'.$file->getClientOriginalName();
        //$file->storeAs('uploads', $filename, 'public');
        $file->move(public_path().'/uploads/', $filename);

       //saving process
       $okSaved = Architectural::create([
            'architectural_title' => $request->architectural_title,
            'architectural_code' => $request->architectural_code,
            'architectural_location' => $request->architectural_location,
            'trade' => $request->trade,
            'attachment' => $filename,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/architectural")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/architectural-add-form")->with('message','There is an error encountered in the saving process');
        }
    }

    public function architecturalUpdateForm(Request $request)
    {
        $architecturalFound = Architectural::where('architectural_id', $request->architectural_id)->first();
        
        if ($architecturalFound)
        {
            return view('architectural.architectural-edit-form', compact('architecturalFound'));

        } else {
            $errorMessage = "architectural ID invalid";
            return view('errors.index', compact('errorMessage'));
        }
        echo'this good';
    }

public function architecturalUpdate(Request $request)
{
    $request->validate([
        'architectural_title' => 'required|string|max:150',
        'architectural_code' => 'required|string|max:100',
        'architectural_location' => 'required|string|max:100',
        'trade' => 'required|string|max:100',
        'attachment' => 'file|mimes:jpeg,png,pdf,gif'
    ]);
   
    $architectural = Architectural::find($request->architectural_id);
    
    if ($architectural) {
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = Auth::user()->id . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $filename);
            $architectural->attachment = $filename;
        }
        
        $architectural->architectural_title = $request->architectural_title;
        $architectural->architectural_code = $request->architectural_code;
        $architectural->architectural_location = $request->architectural_location;
        $architectural->trade = $request->trade;
        // $structural->attachment = $request->attachment;
        
        $okSaved = $architectural->save();
        // echo'this good 123';
        // exit;
        if ($okSaved) {
            return redirect("/architectural")->withSuccess('Product has been successfully updated');
        } else {
            return redirect("/architectural")->with('message', 'Error during the updating process');
        }
    } else {
        $errorMessage = "Product ID invalid";
        return view('errors.index', compact('errorMessage'));
    }
}


    public function architecturalDelete(Request $request)
    {
        if ($request->ajax()) { 
            $architectural = Architectural::find($request->architectural_id);  
            if ($architectural) {
                $architectural->delete(); // Delete the record from the database
                return response()->json(['success' => true]); // Return a success response
            } else {
                return response()->json(['success' => false, 'message' => 'Structural record not found']); // Return an error response
            }
        } else {
            abort(404); // If the request is not AJAX, return a 404 error
        }
    }
}