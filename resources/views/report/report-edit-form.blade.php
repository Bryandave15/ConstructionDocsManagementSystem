@extends('layouts.app')
@section('content')

<style>
    .form-container {
        width: 80%;
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
    .form-container input[type="submit"],
{
        width: calc(100% - 22px); /* Adjusted width to account for padding and border */
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-container input[type="file"],
     {
        width: 100%; /* Full width for file input */
    }

    .form-container input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    .form-container input[type="submit"],button {
        width: calc(40% - 5px);
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        padding: 10px;
    }

    .alert {
        margin-bottom: 15px;
    }

    @media only screen and (max-width: 768px) {
        .form-container {
            width: 90%;
        }
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

    <div class="row justify-content-center">
    <h2> <b> Update Report </b></h2>
        <div class="col-md-12">
            <div class="form-container">
                <form action="{{ route('report_Update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="report_id" value="{{ $reportFound->report_id }}">

                    <div class="form-group">
                        <label for="report_title">report_title Title:</label>
                        <input type="text" id="report_title" name="report_title" class="form-control" value="{{ $reportFound->report_title }}">
                    </div>

                    <div class="form-group">
                        <label for="report_type">report_type:</label>
                        <input type="text" id="report_type" name="report_type" class="form-control" value="{{ $reportFound->report_type }}">
                    </div>

                    <div class="form-group">
                        <label for="description">description:</label>
                        <input type="text" id="description" name="description" class="form-control" value="{{ $reportFound->description }}">
                    </div>

                    <div class="form-group">
                        <label for="created_by">description:</label>
                        <input type="text" id="created_by" name="created_by" class="form-control" value="{{ $reportFound->created_by }}">
                    </div>


                   

                    <div class="form-group">
                        @if (isset($reportFound->attachment))
                            <img width="50" height="50" src="{{ '/uploads/'.$reportFound->attachment }}" />
                        @endif
                        <input type="file" id="attachment" name="attachment" class="form-control-file"><br>
                    </div>

                    <div class="add-button">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button class= "btn-danger">  <a href="/report"> Cancel  </button>
                    </div>

                </form> 
            </div>
        </div>
    </div>
</div>

@endsection
