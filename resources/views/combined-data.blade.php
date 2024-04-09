<!-- resources/views/combined-data.blade.php -->
@extends('layouts.app')

@section('content')

<style>
    .main-container {
        background-color: red;
        
    }
    .custom-card {
        border: 1px solid black; /* Add border to cards */
        border-radius: 0.25rem; /* Optional: Add border radius for better appearance */
        height: 150px; /* Adjust the height of the cards */
        background-color: orange
    }

    .rowcard1 {
        margin-bottom: 10px;
        margin-top: 10px
    }
    .rowcard2 {
        margin-bottom: 10px;
    }

    .table {
        border: 1px solid black;
    }
</style>

<div class="mb-3">
    <form id="searchForm" action="{{ route('combined-data.index') }}" method="GET" class="form-inline">
        <input type="text" id="searchInput" name="search" class="form-control mr-sm-2" placeholder="Search" value="{{ $searchQuery }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>


<Container class= "main-container ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 rowcard1" >
                <div class="row">
                    <!-- First column of cards -->
                    <div class="col-md-4 mb-3">
                        <div class="card custom-card">
                            <div class="card-body">
                                CARD1
                                <h5 class="card-title">Mefps Count</h5>
                                 <p class="card-text">{{ $mefpsCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card custom-card">
                            <div class="card-body">
                                CARD2
                                <h5 class="card-title">Struct Count</h5>
                                 <p class="card-text">{{ $structuralCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card custom-card">
                            <div class="card-body">
                                CARD3
                                <h5 class="card-title">Form Count</h5>
                                 <p class="card-text">{{ $formCount }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat this div structure for each card -->
                </div>
            </div>

            <div class="col-md-12 rowcard2">
                <div class="row">
                    <!-- Second column of cards -->
                    <div class="col-md-4 mb-3">
                        <div class="card custom-card">
                            <div class="card-body">
                               Card2A
                               <h5 class="card-title">Meeting Count</h5>
                                 <p class="card-text">{{ $meetingCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card custom-card">
                            <div class="card-body">
                               Card2A
                               <h5 class="card-title">Report Count</h5>
                                 <p class="card-text">{{ $reportCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card custom-card">
                            <div class="card-body">
                               Card2A
                            </div>
                        </div>
                    </div>
                    <!-- Repeat this div structure for each card -->
                </div>
            </div>
        </div>
    </div>
</Container>


<div class="container">
<!-- Original Table -->
<table id="originalTable" class="table table-responsive text-center">
    <thead>
        <tr>
            <th style="border: 1px solid black;">Title</th>
            <th style="border: 1px solid black;">Code / Type</th>
            <th style="border: 1px solid black;">Location / Description</th>
            <th style="border: 1px solid black;">Created At</th>
                            
        </tr>
    </thead>
    <tbody>
        <!-- Display original table data here -->
        @foreach ($combinedData as $data)
        <tr>
           
            <td style="border: 1px solid black;">{{ $data['title'] }}</td>
            <td style="border: 1px solid black;">{{ $data['code'] }}</td>
            <td style="border: 1px solid black;">{{ $data['location'] }}</td>
            <td style="border: 1px solid black;">{{ $data['created_at'] }}</td>
 
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="searchResultsModal" tabindex="-1" role="dialog" aria-labelledby="searchResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchResultsModalLabel">Search Results</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="searchResultsTable" class="table">
                    <thead>
                        <tr>
                           
                            <th>Title</th>
                            <th>Code / Type</th>
                            <th>Location / Description</th>
                            <th>Created At</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Search results will be populated here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- JavaScript to trigger the modal and populate search results -->
<script>
    // When the document is ready
    $(document).ready(function() {
        // If the search input is not empty, show the modal with search results
        @if (!empty($searchQuery))
            $('#searchResultsModal').modal('show');
        @endif

        // Populate the search results table with data
        var searchResults = @json($searchResults);
        var tableBody = $('#searchResultsTable tbody');
        $.each(searchResults, function(index, data) {
            var row = $('<tr>').appendTo(tableBody);
            $('<td>').text(data.id).appendTo(row);
            $('<td>').text(data.title).appendTo(row);
            $('<td>').text(data.code).appendTo(row);
            $('<td>').text(data.location).appendTo(row);
            $('<td>').text(data.created_at).appendTo(row);
            $('<td>').text(data.updated_at).appendTo(row);
            $('<td>').text(data.trade).appendTo(row);
            $('<td>').text(data.attachment).appendTo(row);
        });
    });
</script>
@endsection
