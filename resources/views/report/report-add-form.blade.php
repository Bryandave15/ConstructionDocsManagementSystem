@extends('layouts.app')
@section('content')

<style>
    .form-container {
        width: 70%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9ff9 ;
    }

    h2 {
        text-align : center;
    }

    .form-container label {
        font-weight: bold;
    }

    .form-container input[type="text"],
    .form-container input[type="file"],
    .form-container input[type="submit"],
    button
     {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-container input[type="submit"],button {
        width: calc(40% - 5px);
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        padding: 10px;
    }

    .add-button {
    display: flex;
    justify-content: space-around; /* Add space between the buttons */

}  
a {
        text-decoration: none;
        color: white;
        
    }

    .form-container input[type="submit"]:hover {
        background-color: #45a049;
    }

    .alert {
        margin-bottom: 15px;
    }

    @media only screen and (max-width: 768px) {
        .form-container {
            width: 80%;
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
    <h2> <b> Add Report </b></h2>

    <form action="{{ route('report_Save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="report_title">Report Title:</label><br>
        <input type="text" id="report_title" name="report_title">

        <label for="report_type">Type:</label><br>
        <input type="text" id="report_type" name="report_type">

        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description">

        <label for="created_by">Created By:</label><br>
        <input type="text" id="created_by" name="created_by">

        <label for="attachment">Attachment:</label><br>
        <input type="file" id="attachment" name="attachment" multiple>

        <div class="add-button">
        <input class="btn btn-primary" type="submit" value="Submit">
        <button class= "btn-danger">  <a href="/report"> Cancel  </button>
        </div>
    </form>
</div>

@endsection
