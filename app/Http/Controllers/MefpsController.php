<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mefps; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Helpers\Fruits;

class MefpsController extends Controller
{
    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated
    }

    //read, selections of fields
    public function index()
    {
       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $mefps_data = Mefps::where('status', 1)->orderBy('mefps_id', 'DESC')->get(); //display the active
        return view('mefps.index', compact('mefps_data'));
    }

    public function mefpsAddForm()
    {  //renders the form
       return view('mefps.mefps-add-form');
    }

    //recieved the form
    public function mefpsSave(Request $request)
    {
        $request->validate([
            'mefps_title' => 'required|string|max:150',
            'mefps_code' => 'required|string|max:100',
            'mefps_location' => 'required|string|max:100',
            'trade' => 'required|string|max:100',
            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
        ]);

        $file = $request->file('attachment');
        $filename = time().'_'.$file->getClientOriginalName();
        //$file->storeAs('uploads', $filename, 'public');
        $file->move(public_path().'/uploads/', $filename);

       //saving process
       $okSaved = Mefps::create([
            'mefps_title' => $request->mefps_title,
            'mefps_code' => $request->mefps_code,
            'mefps_location' => $request->mefps_location,
            'trade' => $request->trade,
            'attachment' => $filename,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/mefps")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/mefps-add-form")->with('message','There is an error encountered in the saving process');
        }
    }

    public function mefpsUpdateForm(Request $request)
    {
        $mefpsFound = Mefps::where('mefps_id', $request->mefps_id)->first();
        
        if ($mefpsFound)
        {
            return view('mefps.mefps-edit-form', compact('mefpsFound'));

        } else {
            $errorMessage = "Structural ID invalid";
            return view('errors.index', compact('errorMessage'));
        }
        echo'this good';
    }

public function mefpsUpdate(Request $request)
{
    $request->validate([
        'mefps_title' => 'required|string|max:150',
        'mefps_code' => 'required|string|max:100',
        'mefps_location' => 'required|string|max:100',
        'trade' => 'required|string|max:100',
        'attachment' => 'file|mimes:jpeg,png,pdf,gif'
    ]);
   
    $mefps = Mefps::find($request->mefps_id);
    
    if ($mefps) {
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = Auth::user()->id . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $filename);
            $mefps->attachment = $filename;
        }
        
        $mefps->mefps_title = $request->mefps_title;
        $mefps->mefps_code = $request->mefps_code;
        $mefps->mefps_location = $request->mefps_location;
        $mefps->trade = $request->trade;
        // $structural->attachment = $request->attachment;
        
        $okSaved = $mefps->save();
        // echo'this good 123';
        // exit;
        if ($okSaved) {
            return redirect("/mefps")->withSuccess('Product has been successfully updated');
        } else {
            return redirect("/mefps")->with('message', 'Error during the updating process');
        }
    } else {
        $errorMessage = "Product ID invalid";
        return view('errors.index', compact('errorMessage'));
    }
}


    public function mefpsDelete(Request $request)
    {
        if ($request->ajax()) { 
            $mefps = Mefps::find($request->mefps_id);  
            if ($mefps) {
                $mefps->delete(); // Delete the record from the database
                return response()->json(['success' => true]); // Return a success response
            } else {
                return response()->json(['success' => false, 'message' => 'Structural record not found']); // Return an error response
            }
        } else {
            abort(404); // If the request is not AJAX, return a 404 error
        }
    }
}