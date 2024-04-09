<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product; //Model
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Helpers\Fruits;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{

    public $sample1;  //example of a property

    public function __construct(){
       $this->middleware('auth'); //it checks if the visitor is authententicated

       $this->sample1 = 'Hi Im a string';

    //    if(Auth::user()->id != 1){
    //         //admin
                
    //    }  

    }

    //read, selections of fields
    public function index()
    {
        //$product_data = Product::where('unit_price', '<=', 80000)->get();
        //$product_data = Product::all(); 
        /*$product_data = Product::where('status', 1)
        ->where('category', 'Computer')
        ->where('unit_price', '>=', 1000)
        ->get();
        */ 
         // 
    ///$p = new ProductController();
    ///$p->sample1 = 'new value';

      /*  echo 'user_id:'. Auth::user()->id;
        echo 'user_email:'. Auth::user()->email;
        echo 'user_name:'. Auth::user()->name;
        */

          //calculate something
         /* $p = new Fruits();

          $x = 50; $y=30; $j=20;
          $sum = $p->calculateSum($x, $y, $j);
          echo 'Sum from class function:'. $sum.'<br />';
          
          $p->set_name('Apple');
          echo 'Fruit Name:'.$p->get_name();
          */
        

        //Session::put('myKey', ['product_1'=>"Umbrella", "product_2"=>"Shoes"]);

       // $product_data = Product::where('status', 1)->orWhere('status', 0)->get(); //display the active
       $product_data = Product::where('status', 1)->orderBy('product_id', 'DESC')->get(); //display the active
       //$response = Http::get('http://example.com');
       //var_dump($response->body());

       return view('products.index', compact('product_data'));
    }

    public function productAddForm()
    {  //renders the form
       $myVariable = "Hello this is me WD95P";
       $myVariable1 = "Hello this is me WD95P";
       $myVariable2 = "We need to pass a class object";
       $myThisVariable =  $this->sample1;
       
       
       //$myVariable = [4, 6, 67, 567, 23, 345, 656, 890];
       return view('products.product-add-form', compact('myVariable', 'myVariable2', 'myThisVariable'));
    }

    //recieved the form
    public function productSave(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:150|min:5',
            'category' => 'required|string|max:100|min:5',
            'unit_price' => 'required|integer|min:2',
            'product_image' => 'required|file|mimes:jpeg,png,gif'
        ]);

        $file = $request->file('product_image');
        $filename = Auth::user()->id.'_'.time().'_'.$file->getClientOriginalName();
        //$file->storeAs('uploads', $filename, 'public');
        $file->move(public_path().'/uploads/', $filename);

       //saving process
       $okSaved = Product::create([
            'product_name' => $request->product_name,
            'category' => $request->category,
            'unit_price' => $request->unit_price,
            'product_image' => $filename,
            'status' => 1
        ]);

        if ($okSaved) {
            return redirect("/products")->withSuccess('Product has been successfuly saved');

        } else {
            return redirect("/products-add-form")->with('message','There is an error encountered in the saving process');
        }

    }

    public function productUpdateForm(Request $request)
    {
        $productFound = Product::where('product_id', $request->product_id)->first();

        $category = ['Computer', 'Gadgets', 'MobilePhone', 'GamesSoftware'];

        if ($productFound)
        {
            return view('products.product-edit-form', compact('productFound', 'category'));

        } else {
            $errorMessage = "Product ID invalid";
            return view('errors.index', compact('errorMessage'));
        }


    }

    public function productUpdate(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:150|min:5',
            'category' => 'required|string|max:100|min:5',
            'unit_price' => 'required|integer|min:2',
            'product_image' => 'required|file|mimes:jpeg,jpg,png,pdf,gif'
        ]);
      
        $product = Product::find($request->product_id);    
       
        if ($product) { //if record exist

            $file = $request->file('product_image');
            $filename = Auth::user()->name.'_'.time().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/uploads/', $filename);

            $product->product_name = $request->product_name;
            $product->category = $request->category;
            $product->unit_price = $request->unit_price;
            $product->product_image = $filename;
            $okSaved = $product->save();

            if ($okSaved) {
                return redirect("/products")->withSuccess('Product has been successfuly updated');
            } else {
                return redirect("/products")->with('message', 'Error during the updating process');
            } 

        } else {

            $errorMessage = "Product ID invalid";
            return view('errors.index', compact('errorMessage'));

        }



    }

    public function productDelete(Request $request)
    {
        if ($request->ajax()) { 
                $product = Product::find($request->product_id);  
                if ($product) {
                    $product->status = 0;
                    $product->save();
                    echo 'Laravel is cool';
                    //sleep(10);
                }

        }
      
    }

    public function productSelect(Request $request)
    {
        $myCreatedSession = Session::get('selectedProducts');
        echo $myCreatedSession; 

        //let myArray = ["Orange", "Apple"]
      $myArray1 = ["Orange", "Apple"];
      $myArray2 = ["firs_freuit"=>"Orange", "second_fruit"=>"Apple"];
        

      $orderDetails = DB::table('order_details as od')
      ->join('orders as o', 'o.order_id', '=', 'od.order_id')
      ->join('products as p', 'p.product_id', '=', 'od.product_id')
      ->join('customers as c', 'c.customer_id', '=', 'o.customer_id')
      ->where('od.product_id', '=', $request->product_id)
      ->select('od.*', 'o.*', 'p.*', 'c.*')
      ->get(); 

      return view('products.product-select', compact('orderDetails'));

    }

    public function productSelectOne(Request $request)
    {
  
        $product = Product::find($request->product_id); 

        if ($product) {
       
           $orderDetails = $product; 

        }

        return view('products.product-selectone', compact('orderDetails'));
    }


    public function productSearch(Request $request)
    {
       $productNameSearch = $request->search_key;
    
       if($productNameSearch !== ''){
         $product_data = Product::where('status', 1)->where("product_name", "LIKE", "%$productNameSearch%")->get(); //search
       } else {
         $product_data = Product::where('status', 1)->orderBy('product_id', 'DESC')->get();
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

    <td><?php echo $d->product_name ?></td> 
    <td><?php echo $d->category ?></td> 
    <td><?php echo $d->unit_price ?></td> 

    <td>
        <button id="butSelect" onclick="processSelect(<?php echo $d->product_id ?>)" class="btn btn-primary">Select</button>
        <button id="butEdit" onclick="processEdit(<?php echo $d->product_id ?>)" class="btn btn-success">Edit</button>
        <button id="butDelete" onclick="processDelete(<?php echo $d->product_id ?>)" class="btn btn-danger">Delete</button>
    </td> 
    
</tr>    
<?php } ?>
</tbody>
</table>
<?php

    }

}
