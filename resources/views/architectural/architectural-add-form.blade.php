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
    .form-container input[type="submit"], select, button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-container input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
        background-color: #45a049;
    }
    a {
            text-decoration: none;
            color: white;
        }
    h2 {
        text-align : center;
    }
    button{
        margin: 2px
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
<h2> <b> Add Architectural Drawing </b></h2>
    <form action="{{ route('architectural_Save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="architectural_title">Drawing Title:</label><br>
        <input type="text" id="architectural_title" name="architectural_title"><br><br>

        <label for="architectural_code">Code:</label><br>
        <input type="text" id="architectural_code" name="architectural_code"><br><br>

        <label for="architectural_location">Location:</label><br>
        <input type="text" id="architectural_location" name="architectural_location"><br><br>

        <label for="Trade">Trade:</label><br>
        <select type="text" id="trade" name="trade">
            <option value="Mechanical">Mechanical</option>
            <option value="Electrical">Electrical</option>
            <option value="Fire Protection">Fire Protection</option>
            <option value="Plumbing/Sanitary">Plumbing/Sanitary</option>
            <option value="Auxillary">Auxillary</option>
        </select>
        <br><br>
        <label for="attachment">Attachment:</label><br>
        <input type="file" id="attachment" name="attachment" multiple><br><br>

        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
    <button class= "btn-danger">  <a href="architectural"> Cancel  </button>
</div>

@endsection