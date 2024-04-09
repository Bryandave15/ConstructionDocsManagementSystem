
@extends('layouts.app')
@section('content')


<div class="card" style="width: 18rem;">
  
 <?php if (isset($orderDetails[0])) {  ?>
  <div class="card-body">
    <h5 class="card-title">Product Name</h5>
     <p class="card-text">{{ $orderDetails[0]->product_name }}</p>
  </div>

  <div class="card-body">
    <h5 class="card-title">Unit Price</h5>
     <p class="card-text">{{ $orderDetails[0]->unit_price }}</p>
  </div>


  <div class="card-body">
    <h5 class="card-title">Buyers Name</h5>
     <p class="card-text">{{ $orderDetails[0]->contact_name }}</p>
  </div>
<?php }  ?>

  


    <a href="/products" class="btn btn-primary">Go Back to List of Products</a>
</div>



@endsection