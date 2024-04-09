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

<?php if (is_array($myVariable)) {

    foreach($myVariable as $d) {
        echo $d . '<br />';
    }

  } else { 
   ?>
    {{ $myVariable }}
<?php
} 
?>

<form action="{{ route('product_Save') }}" method="POST" enctype="multipart/form-data">
@csrf
  <label for="product_name">Product Name:</label><br>
  <input type="text" id="product_name" name="product_name"><br><br>

  <label for="category">Product Category:</label><br>
  <select name="category" id="category">
    <option value="Computer">Computer</option>
    <option value="Gadgets">Gadgets</option>
    <option value="MobilePhone">Mobile Phone</option>
    <option value="Games">Games Software</option>
</select><br><br>

  <label for="unit_price">Product Price:</label><br>
  <input type="text" id="unit_price" name="unit_price"><br><br>
  
  <label for="unit_price">Product Image:</label><br>
  
  <input type="file" id="product_image" name="product_image"><br><br>

  <input class="btn btn-primary" type="submit" value="Submit">
</form> 

@endsection