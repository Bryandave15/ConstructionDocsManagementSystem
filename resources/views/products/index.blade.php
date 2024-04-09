
@extends('layouts.app')
@section('content')


@if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
@endif

@if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
@endif

<a class="btn btn-primary" href="http://127.0.0.1:8000/products-add-form">Add Product</a>



<div align="right">Search Product Name: <input type="text" onkeyup="processSearch()" name="searchText" id="searchText"></div>

<div id="productData">
    <table class="table table-dark">
    <thead>
    <tr>
    <th>Product Name</th>
    <th>Category</th>
    <th>Unit Price</th>
    <th>Image</th>
    <th>Actions</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($product_data as $d)
    <tr>

        <td>{{ $d->product_name }}</td> 
        <td>{{ $d->category }}</td> 
        <td>{{ $d->unit_price }}</td> 
        <td>{{ $d->product_image }}</td> 

        <td>
            <button id="butSelect" onclick="processSelect({{ $d->product_id }})" class="btn btn-primary">Select</button>
            <button id="butEdit" onclick="processEdit({{ $d->product_id }})" class="btn btn-success">Edit</button>
            <button id="butDelete" onclick="processDelete({{ $d->product_id }})" class="btn btn-danger">Delete</button>
        </td> 
        
    </tr>    
    @endforeach
    </tbody>
    </table>
</div>

<script>

function processSearch(){
   var search = document.getElementById('searchText').value;
   if (search.length >= 0) {

    $.post("{{ url('product-search') }}",
        {
            _token: '{!! csrf_token() !!}',
            search_key: search,
        },
        function(data, status){
           // alert("Data: " + data + "\nStatus: " + status);
           // console.log("Data: " + data + "\nStatus: " + status);
           document.getElementById("productData").innerHTML = data;          
        }
        );
   }  
}

$(document).ajaxStart(function() {
    $('#status_request').show();
});
 
$(document).ajaxStop(function() {
    $('#status_request').hide();
});

 

function processSelect(pId){
    window.location.href = '/product-select/'+pId 
}    

function processEdit(pId)
{
    window.location.href = '/products-update-form/'+pId 
}

function processDelete(pId)
{
  let text = "Are you sure to delete this record?.";
  if (confirm(text) == true) {

        $.post("{{ url('products-del') }}",
        {
            _token: '{!! csrf_token() !!}',
            product_id: pId,
            
        },
        function(data, status){
            
            //alert("Data: " + data + "\nStatus: " + status);
            window.location.href = '/products';   
                
        }
        );

  } 


}

</script>


@endsection


