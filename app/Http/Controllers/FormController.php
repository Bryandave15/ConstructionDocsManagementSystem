<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Form; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Helpers\Fruits;

class FormController extends Controller
{



    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated

    }

    //read, selections of fields
    public function index()
    {
       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $form_data = Form::where('status', 1)->orderBy('form_id', 'DESC')->get(); //display the active
        return view('form.index', compact('form_data'));
    }

    public function formAddForm()
    {  //renders the form
       return view('form.form-add-form');
    }

    //recieved the form
    public function formSave(Request $request)
    {
        $request->validate([
            'form_title' => 'required|string|max:150',
            'form_type' => 'required|string|max:100',
            'description' => 'required|string|max:100',
            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
        ]);

        $file = $request->file('attachment');
        $filename = time().'_'.$file->getClientOriginalName();
        //$file->storeAs('uploads', $filename, 'public');
        $file->move(public_path().'/uploads/', $filename);

       //saving process
       $okSaved = Form::create([
            'form_title' => $request->form_title,
            'form_type' => $request->form_type,
            'description' => $request->description,
            'attachment' => $filename,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/form")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/form-add-form")->with('message','There is an error encountered in the saving process');
        }
    }

    public function formUpdateForm(Request $request)
    {
        $formFound = Form::where('form_id', $request->form_id)->first();
        
        if ($formFound)
        {
            return view('form.form-edit-form', compact('formFound'));

        } else {
            $errorMessage = "form ID invalid";
            return view('errors.index', compact('errorMessage'));
        }
        echo'this good';
    }

public function formUpdate(Request $request)
{
    $request->validate([
        'form_title' => 'required|string|max:150',
            'form_type' => 'required|string|max:100',
            'description' => 'required|string|max:100',
            'attachment.*' => 'required|file|mimes:jpeg,png,pdf,gif'
    ]);
   
    $form = Form::find($request->form_id);
    
    if ($form) {
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = Auth::user()->id . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $filename);
            $form->attachment = $filename;
        }
        
        $form->form_title = $request->form_title;
        $form->form_type = $request->form_type;
        $form->description = $request->description;
        // return redirect("/form")->withSuccess('Product has been successfully updated');
        // $structural->attachment = $request->attachment;
        
        $okSaved = $form->save();
        // echo'this good 123';
        // exit;
        if ($okSaved) {
            return redirect("/form")->withSuccess('Product has been successfully updated');
        } else {
            return redirect("/form")->with('message', 'Error during the updating process');
        }
    } else {
        $errorMessage = "Product ID invalid";
        return view('errors.index', compact('errorMessage'));
    }
}


    public function formDelete(Request $request)
    {
        if ($request->ajax()) { 
            $form = Form::find($request->form_id);  
            if ($form) {
                $form->delete(); // Delete the record from the database
                return response()->json(['success' => true]); // Return a success response
            } else {
                return response()->json(['success' => false, 'message' => 'form record not found']); // Return an error response
            }
        } else {
            abort(404); // If the request is not AJAX, return a 404 error
        }
    }
}