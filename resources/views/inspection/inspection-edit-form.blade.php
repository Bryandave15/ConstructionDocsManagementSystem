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
<h2> <b> Update Inspection </b></h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-container">
                <form action="{{ route('inspection_Update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="inspection_id" value="{{ $inspectionFound->inspection_id }}">

                    <div class="form-group">
                        <label for="inspection_title">Title:</label>
                        <input type="text" id="inspection_title" name="inspection_title" class="form-control" value="{{ $inspectionFound->inspection_title }}">
                    </div>

                    <div class="form-group">
                        <label for="inspection_code">Code:</label>
                        <input type="text" id="inspection_code" name="inspection_code" class="form-control" value="{{ $inspectionFound->inspection_code }}">
                    </div>

                    <div class="form-group">
                        <label for="inspection_type">Type:</label>
                        <select type="text" id="inspection_type" name="inspection_type" class="form-control" value="{{ $inspectionFound->inspection_type }}">
                            <option value="Architectural">Architectural</option>
                            <option value="Structural">Structural</option>
                            <option value="Facade">Facade</option>
                            <option value="Mechanical">Mechanical</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Fire Protection">Fire Protection</option>
                            <option value="Plumbing/Sanitary">Plumbing/Sanitary</option>
                            <option value="Auxillary">Auxillary</option>
                        </select>      
                    </div>

                    <div class="form-group">
                        <label for="inspection_category">Category:</label>
                        <select type="text" id="inspection_category" name="inspection_category" class="form-control" value="{{ $inspectionFound->inspection_category }}">
                        <option value="Internal Testing">Internal Testing</option>
                        <option value="Initial Testing">Initial Testing</option>
                        <option value="Final Testing">Final Testing</option>
                     </select>      
                    </div>
                    
                    <div class="form-group">
                        <label for="inspection_date">Date:</label>
                        <input type="date" id="inspection_date" name="inspection_date" class="form-control" value="{{ $inspectionFound->inspection_date }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" id="description" name="description" class="form-control" value="{{ $inspectionFound->description }}">
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <select type="text" id="remarks" name="remarks" class="form-control" value="{{ $inspectionFound->remarks }}">
                            <option value="Pass">Pass</option>
                            <option value="Fail">Fail</option>  
                     </select>      
                    </div>

                    <div class="form-group">
                        @if (isset($inspectionFound->attachment))
                            <img width="50" height="50" src="{{ '/uploads/'.$inspectionFound->attachment }}" />
                        @endif
                        <input type="file" id="attachment" name="attachment" class="form-control-file"><br>
                    </div>

                    <div class="add-button">
                    <button type="submit" class=" btn-primary">Submit</button>
                    <button class= "btn-danger">  <a href="/inspection"> Cancel  </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

@endsection
