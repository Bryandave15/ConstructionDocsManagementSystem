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
    .form-container input[type="submit"], button {
        width: calc(100% - 22px); /* Adjusted width to account for padding and border */
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-container input[type="file"] {
        width: 100%; /* Full width for file input */
    }

    .form-container input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
        background-color: #45a049;
    }
    .add-button {
    display: flex;
    justify-content: space-around; /* Add space between the buttons */
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

<div class="container">
<h2> <b> Update Personnel Data </b></h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-container">
                <form action="{{ route('directory_Update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="directory_id" value="{{ $directoryFound->directory_id }}">

                    <div class="form-group">
                        <label for="fullname">fullname Title:</label>
                        <input type="text" id="fullname" name="fullname" class="form-control" value="{{ $directoryFound->fullname }}">
                    </div>

                    <div class="form-group">
                        <label for="jobtitle">jobtitle:</label>
                        <input type="text" id="jobtitle" name="jobtitle" class="form-control" value="{{ $directoryFound->jobtitle }}">
                    </div>

                    <div class="form-group">
                        <label for="email">email:</label>
                        <input type="text" id="email" name="email" class="form-control" value="{{ $directoryFound->email }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone_number">phone_number:</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ $directoryFound->phone_number }}">
                    </div>


                    
                    <div class="form-group">
                        <label for="address">address:</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ $directoryFound->address }}">
                    </div>

                    <div class="form-group">
                        <label for="company">company:</label>
                        <input type="text" id="company" name="company" class="form-control" value="{{ $directoryFound->company }}">
                    </div>



                   

                    <div class="form-group">
                        @if (isset($directoryFound->attachment))
                            <img width="50" height="50" src="{{ '/uploads/'.$directoryFound->attachment }}" />
                        @endif
                        <input type="file" id="attachment" name="attachment" class="form-control-file"><br>
                    </div>

                    <div class="add-button">
                    <button type="submit" class=" btn-primary">Submit</button>
                    <button class= "btn-danger">  <a href="/directory"> Cancel  </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

@endsection
