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

    public function directoryUpdateForm(Request $request)
    {
        $directoryFound = Directory::where('directory_id', $request->directory_id)->first();
        
        if ($directoryFound)
        {
            return view('directory.directory-edit-form', compact('directoryFound'));

        } else {
            $errorMessage = "directory ID invalid";
            return view('errors.index', compact('errorMessage'));
        }
        echo'this good';
    }

public function directoryUpdate(Request $request)
{
    $request->validate([
        'fullname' => 'string|max:150',
        'jobtitle' => 'string|max:100',
        'email' => 'string|max:100',
        'phone_number' => 'string|max:100',
        'address' => 'string|max:100',
        'company' => 'string|max:100',
    ]);
   
    $directory = Directory::find($request->directory_id);
    
    if ($directory) {

        $directory->fullname = $request->fullname;
        $directory->jobtitle = $request->jobtitle;
        $directory->email = $request->email;
        $directory->phone_number = $request->phone_number;
        $directory->address = $request->address;
        $directory->company = $request->company;
       
        $okSaved = $directory->save();
 

        if ($okSaved) {
            return redirect("/directory")->withSuccess('Product has been successfully updated');
        } else {
            return redirect("/directory")->with('message', 'Error during the updating process');
        }
    } else {
        $errorMessage = "Product ID invalid";
        return view('errors.index', compact('errorMessage'));
    }
}


    public function directoryDelete(Request $request)
    {
        if ($request->ajax()) { 
            $directory = Directory::find($request->directory_id);  
            if ($directory) {
                $directory->delete(); // Delete the record from the database
                return response()->json(['success' => true]); // Return a success response
            } else {
                return response()->json(['success' => false, 'message' => 'directory record not found']); // Return an error response
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

