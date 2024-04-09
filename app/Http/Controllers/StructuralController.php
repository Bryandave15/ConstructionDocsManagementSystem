<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Structural; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Helpers\Fruits;

class StructuralController extends Controller
{

    public $sample1;  //example of a property

    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated

    }

    //read, selections of fields
    public function index()
    {
       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $structural_data = Structural::where('status', 1)->orderBy('structural_id', 'DESC')->get(); //display the active
        return view('structural.index', compact('structural_data'));
    }

    public function structuralAddForm()
    {  //renders the form
       return view('structural.structural-add-form');
    }

    //recieved the form
    public function structuralSave(Request $request)
    {
        $request->validate([
            'structural_title' => 'required|string|max:150',
            'structural_code' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'trade' => 'required|string|max:100',
            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
        ]);

        $file = $request->file('attachment');
        $filename = time().'_'.$file->getClientOriginalName();
        //$file->storeAs('uploads', $filename, 'public');
        $file->move(public_path().'/uploads/', $filename);

       //saving process
       $okSaved = Structural::create([
            'structural_title' => $request->structural_title,
            'structural_code' => $request->structural_code,
            'location' => $request->location,
            'trade' => $request->trade,
            'attachment' => $filename,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/structural")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/structural-add-form")->with('message','There is an error encountered in the saving process');
        }
    }

    public function structuralUpdateForm(Request $request)
    {
        $structuralFound = Structural::where('structural_id', $request->structural_id)->first();
        
        if ($structuralFound)
        {
            return view('structural.structural-edit-form', compact('structuralFound'));

        } else {
            $errorMessage = "Structural ID invalid";
            return view('errors.index', compact('errorMessage'));
        }
        echo'this good';
    }

public function structuralUpdate(Request $request)
{
    $request->validate([
        'structural_title' => 'required|string|max:150',
        'structural_code' => 'required|string|max:100',
        'location' => 'required|string|max:100',
        'trade' => 'required|string|max:100',
        'attachment' => 'file|mimes:jpeg,png,pdf,gif'
    ]);
   
    $structural = Structural::find($request->structural_id);
    
    if ($structural) {
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = Auth::user()->id . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $filename);
            $structural->attachment = $filename;
        }
        
        $structural->structural_title = $request->structural_title;
        $structural->structural_code = $request->structural_code;
        $structural->location = $request->location;
        $structural->trade = $request->trade;
        // $structural->attachment = $request->attachment;
        
        $okSaved = $structural->save();
        // echo'this good 123';
        // exit;
        if ($okSaved) {
            return redirect("/structural")->withSuccess('Product has been successfully updated');
        } else {
            return redirect("/structural")->with('message', 'Error during the updating process');
        }
    } else {
        $errorMessage = "Product ID invalid";
        return view('errors.index', compact('errorMessage'));
    }
}


    public function structuralDelete(Request $request)
    {
        if ($request->ajax()) { 
            $structural = Structural::find($request->structural_id);  
            if ($structural) {
                $structural->delete(); // Delete the record from the database
                return response()->json(['success' => true]); // Return a success response
            } else {
                return response()->json(['success' => false, 'message' => 'Structural record not found']); // Return an error response
            }
        } else {
            abort(404); // If the request is not AJAX, return a 404 error
        }
    }
}