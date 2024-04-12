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
<h2> <b> Update Meeting </b></h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-container">
                <form action="{{ route('meeting_Update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="meeting_id" value="{{ $meetingFound->meeting_id }}">

                    <div class="form-group">
                        <label for="meeting_title">Structural Title:</label>
                        <input type="text" id="meeting_title" name="meeting_title" class="form-control" value="{{ $meetingFound->meeting_title }}">
                    </div>

                    <div class="form-group">
                        <label for="meeting_overview">Code:</label>
                        <input type="text" id="meeting_overview" name="meeting_overview" class="form-control" value="{{ $meetingFound->meeting_overview }}">
                    </div>

                    <div class="form-group">
                        <label for="meeting_date">Date:</label>
                        <input type="date" id="meeting_date" name="meeting_date" class="form-control" value="{{ $meetingFound->meeting_date }}">
                    </div>

                    <div class="form-group">
                        <label for="meeting_location">meeting_location:</label>
                        <input type="text" id="meeting_location" name="meeting_location" class="form-control" value="{{ $meetingFound->meeting_location }}">
                    </div>

                    <div class="form-group">
                        <label for="meeting_agenda">meeting_agenda:</label>
                        <input type="text" id="meeting_agenda" name="meeting_agenda" class="form-control" value="{{ $meetingFound->meeting_agenda }}">
                    </div>

                    <div class="form-group">
                        <label for="minutes_meeting">minutes_meeting:</label>
                        <input type="text" id="minutes_meeting" name="minutes_meeting" class="form-control" value="{{ $meetingFound->minutes_meeting }}">
                    </div>

                    <div class="form-group">
                        @if (isset($meetingFound->attachment))
                            <img width="50" height="50" src="{{'/uploads/'.$meetingFound->attachment }}" />
                        @endif
                        <input type="file" id="attachment" name="attachment" class="form-control-file"><br>
                    </div>

                    <div class="add-button">
                    <button type="submit" class=" btn-primary">Submit</button> 
                    <button class= "btn-danger">  <a href="/meeting"> Cancel  </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

@endsection
