@extends('layouts.app')
@section('content')

<style>
    .form-container, select {
        width: 50%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    
   

    .form-container label, select {
        font-weight: bold;
    }

    .form-container input[type="text"],
    .form-container input[type="file"],
    .form-container input[type="submit"], select,
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    a {
        text-decoration: none;
        color: white;
        
    }
    h2 {
        text-align : center;
    }

    .form-container input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
        background-color: #45a049;
    }

    .alert {
        margin-bottom: 15px;
    }

    @media only screen and (max-width: 768px) {
        .form-container {
            width: 90%;
        }
    }
</style>

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

<div class="form-container">
<h2> <b> Add Inspection </b></h2>
    <form action="{{ route('inspection_Save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="inspection_title">Inspection Title:</label><br>
        <input type="text" id="inspection_title" name="inspection_title"><br><br>

        <label for="inspection_code">Inspection Code:</label><br>
        <input type="text" id="inspection_code" name="inspection_code"><br><br>

        <label for="inspection_type">Type:</label><br>
        <select type="text" id="inspection_type" name="inspection_type">
            <option value="Architectural">Architectural</option>
            <option value="Structural">Structural</option>
            <option value="Facade">Facade</option>
            <option value="Mechanical">Mechanical</option>
            <option value="Electrical">Electrical</option>
            <option value="Fire Protection">Fire Protection</option>
            <option value="Plumbing/Sanitary">Plumbing/Sanitary</option>
            <option value="Auxillary">Auxillary</option>
        </select>
        <br><br>

        <label for="inspection_category">Category:</label><br>
        <select type="text" id="inspection_category" name="inspection_category">
            <option value="Internal Testing">Internal Testing</option>
            <option value="Initial Testing">Initial Testing</option>
            <option value="Final Testing">Final Testing</option>
         
        </select>
        <br><br>

        <label for="inspection_date">Inspection Date:</label><br>
        <input type="date" id="inspection_date" name="inspection_date"><br><br>

        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description"><br><br>

        <label for="remarks">Remarks:</label><br>
        <select type="text" id="remarks" name="remarks">
            <option value="Pass">Pass</option>
            <option value="Fail">Fail</option>
          
        </select>
        <br><br>

      
        <label for="attachment">Attachment:</label><br>
        <input type="file" id="attachment" name="attachment" multiple><br><br>

        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
         
    <button class= "btn-danger">  <a href="/inspection"> Cancel  </button>
</div>

@endsection
