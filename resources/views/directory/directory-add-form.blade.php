@extends('layouts.app')
@section('content')

<style>
    .form-container {
        width: 50%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .form-container label {
        font-weight: bold;
    }

    .form-container input[type="text"],
    .form-container input[type="file"],
    .form-container input[type="submit"] {
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
    <form action="{{ route('directory_Save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="fullname">fullname:</label><br>
        <input type="text" id="fullname" name="fullname"><br><br>

        <label for="jobtitle">Type:</label><br>
        <input type="text" id="jobtitle" name="jobtitle"><br><br>

        <label for="email">email:</label><br>
        <input type="text" id="email" name="email"><br><br>


        <label for="phone_number">phone_number:</label><br>
        <input type="number" id="phone_number" name="phone_number"><br><br>

        <label for="address">address:</label><br>
        <input type="text" id="address" name="address"><br><br>

        <label for="company">company:</label><br>
        <input type="text" id="company" name="company"><br><br>

        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
</div>

@endsection