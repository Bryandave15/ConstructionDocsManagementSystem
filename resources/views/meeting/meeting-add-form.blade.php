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
    <form action="{{ route('meeting_Save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="meeting_title">Meeting Name:</label><br>
        <input type="text" id="meeting_title" name="meeting_title"><br><br>

        <label for="meeting_overview">Meeting Overview</label><br>
        <input type="text" id="meeting_overview" name="meeting_overview"><br><br>

        <label for="meeting_location">Location:</label><br>
        <input type="text" id="meeting_location" name="meeting_location"><br><br>

        <label for="meeting_agenda">Meeting Agenda:</label><br>
        <input type="text" id="meeting_agenda" name="meeting_agenda"><br><br>

        <label for="minutes_meeting">Minutes:</label><br>
        <input type="text" id="minutes_meeting" name="minutes_meeting"><br><br>

        <label for="attachment">Attachment:</label><br>
        <input type="file" id="attachment" name="attachment" multiple><br><br>

        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
</div>

@endsection
