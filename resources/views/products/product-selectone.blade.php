
@extends('layouts.app')
@section('content')


<div class="card" style="width: 18rem;">
  
 <?php if (isset($orderDetails)) {  ?>'
    
  
 <div class="card-body">
    <h5 class="card-title">Product Image</h5>
     <p class="card-text">
     <img width="150" src="{{ 'http://127.0.0.1:8000/uploads/'.$orderDetails->product_image }}" />
     </p>
  </div>  
  
  <div class="card-body">
    <h5 class="card-title">Product Name</h5>
     <p class="card-text">{{ $orderDetails->product_name }}</p>
  </div>


  <div class="card-body">
    <h5 class="card-title">Unit Price</h5>
     <p class="card-text">{{ $orderDetails->unit_price }}</p>
  </div>


  <div class="card-body">
    <h5 class="card-title">Buyers Name</h5>
     <p class="card-text">{{ $orderDetails->contact_name }}</p>
  </div>
<?php }  ?>

  


    <a href="/products" class="btn btn-primary">Go Back to List of Products</a>
    <br />
    <button class="btn btn-success" onclick="processAdtoCart('{{ $orderDetails->product_id }}')"> Add to Cart </button>
</div>

<script>

   function processAdtoCart(productId, url){
      
      $.post("{{ url('cart-insert') }}",
        {
            _token: '{!! csrf_token() !!}',
            product_id: productId,
        },
        function(data, status){
           //alert("Data: " + data + "\nStatus: " + status);
           // console.log("Data: " + data + "\nStatus: " + status);
           if (status == 'success') {
               alert('Product added to cart successfully!');   
               window.location.href = data; 
           }
        }
        );


   }

</script>

@endsection