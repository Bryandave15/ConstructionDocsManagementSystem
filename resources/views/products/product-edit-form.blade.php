

@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
@endif


@if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
@endif


<form action="{{ route('product_Update') }}" method="POST" enctype="multipart/form-data">
@csrf
<input type="hidden" name="product_id" value="{{ $productFound->product_id }}">
  <label for="product_name">Product Name:</label><br>
  <input type="text" id="product_name" name="product_name" value="{{ $productFound->product_name }}"> <br><br>

  <label for="category">Product Category:</label><br>
  <select name="category" id="category">
   <?php   
   foreach($category as $cat)
   {
   ?>
    <?php if($productFound->category == $cat){ ?>
    <option selected value="{{ $cat }}"> {{ $cat }}</option>
    <?php } else { ?>
    <option value="{{ $cat }}"> {{ $cat }}</option>
    <?php } ?>
   <?php
    }
   ?>
  
</select><br><br>

  <label for="unit_price">Product Price:</label><br>
  <input type="text" id="unit_price" name="unit_price" value="<?php echo $productFound->unit_price ?>"><br><br>
  
  <?php if (isset($productFound->product_image)) { ?>
  <img width="50" height="50" src="{{ 'http://127.0.0.1:8000/uploads/'.$productFound->product_image }}" />
  <?php } ?>   

  <input type="file" id="product_image" name="product_image"><br><br>

  <input type="submit" value="Submit">
</form> 

@endsection