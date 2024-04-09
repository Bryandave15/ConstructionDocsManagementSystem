<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Directory; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



class DirectoryController extends Controller
{


    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated

    }

    //read, selections of fields
    public function index()
    {
       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $directory_data = Directory::where('status', 1)->orderBy('directory_id', 'DESC')->get(); //display the active
        return view('directory.index', compact('directory_data'));
    }

    public function directoryAddForm()
    {  //renders the form
       return view('directory.directory-add-form');
    }

    //recieved the form
    public function directorySave(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:150',
            'jobtitle' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'phone_number' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'company' => 'required|string|max:100',

        
        ]);

     

       //saving process
       $okSaved = Directory::create([
            'fullname' => $request->fullname,
            'jobtitle' => $request->jobtitle,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'company' => $request->company,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/directory")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/directory-add-form")->with('message','There is an error encountered in the saving process');
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


    public function directorySearch(Request $request)
    {
       $directoryNameSearch = $request->search_key;
    
       if($directoryNameSearch !== ''){
         $directory_data = Directory::where('status', 1)->where("directory_name", "LIKE", "%$directoryNameSearch%")->get(); //search
       } else {
         $directory_data = Directory::where('status', 1)->orderBy('directory_id', 'DESC')->get();
       }
        ?>
<table class="table table-dark">
<thead>
<tr>
<th>Product Name</th>
<th>Category</th>
<th>Unit Price</th>
<th>Actions</th>
</tr>
</thead>
<tbody>

<?php foreach($product_data as $d) { ?>
<tr>

    <td><?php echo $d->fullname ?></td> 
    <td><?php echo $d->jobtitle ?></td> 
    <td><?php echo $d->email ?></td> 
    <td><?php echo $d->phone_number ?></td> 
    <td><?php echo $d->address ?></td> 
    <td><?php echo $d->company ?></td> 


    <td>
        <button id="butSelect" onclick="processSelect(<?php echo $d->directory_id ?>)" class="btn btn-primary">Select</button>
        <button id="butEdit" onclick="processEdit(<?php echo $d->directory_id ?>)" class="btn btn-success">Edit</button>
        <button id="butDelete" onclick="processDelete(<?php echo $d->directory_id ?>)" class="btn btn-danger">Delete</button>
    </td> 
    
</tr>    
<?php } ?>
</tbody>
</table>
<?php

    }



}

