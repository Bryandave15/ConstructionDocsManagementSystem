<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Asbuilt; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AsbuiltController extends Controller
{
    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated
    }

    //read, selections of fields
    public function index()
    {
       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $asbuilt_data = Asbuilt::where('status', 1)->orderBy('asbuilt_id', 'DESC')->get(); //display the active
        return view('asbuilt.index', compact('asbuilt_data'));
    }

    public function asbuiltAddForm()
    {  //renders the form
       return view('asbuilt.asbuilt-add-form');
    }

    //recieved the form
    public function asbuiltSave(Request $request)
    {
        $request->validate([
            'asbuilt_title' => 'required|string|max:150',
            'asbuilt_code' => 'required|string|max:100',
            'asbuilt_location' => 'required|string|max:100',
            'trade' => 'required|string|max:100',
            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
        ]);

        $file = $request->file('attachment');
        $filename = time().'_'.$file->getClientOriginalName();
        //$file->storeAs('uploads', $filename, 'public');
        $file->move(public_path().'/uploads/', $filename);

       //saving process
       $okSaved = Asbuilt::create([
            'asbuilt_title' => $request->asbuilt_title,
            'asbuilt_code' => $request->asbuilt_code,
            'asbuilt_location' => $request->asbuilt_location,
            'trade' => $request->trade,
            'attachment' => $filename,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/asbuilt")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/asbuilt-add-form")->with('message','There is an error encountered in the saving process');
        }
    }

    public function asbuiltUpdateForm(Request $request)
    {
        $asbuiltFound = Asbuilt::where('asbuilt_id', $request->asbuilt_id)->first();
        
        if ($asbuiltFound)
        {
            return view('asbuilt.asbuilt-edit-form', compact('asbuiltFound'));

        } else {
            $errorMessage = "Structural ID invalid";
            return view('errors.index', compact('errorMessage'));
        }
        echo'this good';
    }

public function asbuiltUpdate(Request $request)
{
    $request->validate([
        'asbuilt_title' => 'required|string|max:150',
        'asbuilt_code' => 'required|string|max:100',
        'asbuilt_location' => 'required|string|max:100',
        'trade' => 'required|string|max:100',
        'attachment' => 'file|mimes:jpeg,png,pdf,gif'
    ]);
   
    $asbuilt = Asbuilt::find($request->asbuilt_id);
    
    if ($asbuilt) {
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = Auth::user()->id . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $filename);
            $asbuilt->attachment = $filename;
        }
        
        $asbuilt->asbuilt_title = $request->asbuilt_title;
        $asbuilt->asbuilt_code = $request->asbuilt_code;
        $asbuilt->asbuilt_location = $request->asbuilt_location;
        $asbuilt->trade = $request->trade;
        // $structural->attachment = $request->attachment;
        
        $okSaved = $asbuilt->save();
        // echo'this good 123';
        // exit;
        if ($okSaved) {
            return redirect("/asbuilt")->withSuccess('Product has been successfully updated');
        } else {
            return redirect("/asbuilt")->with('message', 'Error during the updating process');
        }
    } else {
        $errorMessage = "Product ID invalid";
        return view('errors.index', compact('errorMessage'));
    }
}


    public function asbuiltDelete(Request $request)
    {
        if ($request->ajax()) { 
            $asbuilt = Asbuilt::find($request->asbuilt_id);  
            if ($asbuilt) {
                $asbuilt->delete(); // Delete the record from the database
                return response()->json(['success' => true]); // Return a success response
            } else {
                return response()->json(['success' => false, 'message' => 'Structural record not found']); // Return an error response
            }
        } else {
            abort(404); // If the request is not AJAX, return a 404 error
        }
    }
}