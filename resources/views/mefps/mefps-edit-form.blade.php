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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-container">
                <form action="{{ route('mefps_Update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="mefps_id" value="{{ $mefpsFound->mefps_id }}">

                    <div class="form-group">
                        <label for="mefps_title">Mefps Title:</label>
                        <input type="text" id="mefps_title" name="mefps_title" class="form-control" value="{{ $mefpsFound->mefps_title }}">
                    </div>

                    <div class="form-group">
                        <label for="mefps_code">Code:</label>
                        <input type="text" id="mefps_code" name="mefps_code" class="form-control" value="{{ $mefpsFound->mefps_code }}">
                    </div>

                    <div class="form-group">
                        <label for="mefps_location">Location:</label>
                        <input type="text" id="mefps_location" name="mefps_location" class="form-control" value="{{ $mefpsFound->location }}">
                    </div>

                    <div class="form-group">
                        <label for="trade">Trade:</label>
                        <input type="text" id="trade" name="trade" class="form-control" value="{{ $mefpsFound->trade }}">
                    </div>

                    <div class="form-group">
                        @if (isset($mefpsFound->attachment))
                            <img width="50" height="50" src="{{ 'http://127.0.0.1:8000/uploads/'.$mefpsFound->attachment }}" />
                        @endif
                        <input type="file" id="attachment" name="attachment" class="form-control-file"><br>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form> 
            </div>
        </div>
    </div>
</div>

@endsection
