<!-- resources/views/combined-data.blade.php -->
@extends('layouts.app')

@section('content')

<style>

    body {
      background-color: #f5f5f5;
    }

    .recently-added {
      background-color: white;
      border: 1px solid darkblue;
      letter-spacing:5px

    }

    .main-container {
        padding: 10px;
        
    }
    .custom-card {
    border: 1px solid darkblue; /* Add border to cards */
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 0.25rem; /* Optional: Add border radius for better appearance */
    height: 150px; /* Adjust the height of the cards */
    background-color: #FFFFFF; /* Set background color to white */
   
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add box shadow for a subtle effect */
}

.card-title {
    font-size: 2rem; /* Increase font size for card titles */
    margin-bottom: 0.5rem; /* Add some space below the card title */
    border-bottom: 1px solid black;
    padding-bottom:10px;
    padding-left:20px;
    text: darkblue;
    
}

.card-text {
    font-size: 2rem; /* Set font size for card text */
    padding-bottom:10px;
    margin-bottom: 20px ; /* Remove margin below the card text */
    border-bottom: 1px solid black;
    text: darkblue;
}

.table {
        border: 1px solid black;
}

  

.search-bar {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50%;
  max-width: 600px;
  margin: 0 auto;
  padding: 10px;
  /* border: 1px solid #ccc; */
  border-radius: 5px;
}

.search-form{
    width: 100%;
  max-width: 600px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.input-group{
    display: flex;
  align-items: center;
  justify-content: center;
}
.search-input {
    
  flex-grow: 1;
  padding: 5px;
  font-size: 16px;
  border: none;
  outline: none;
  
}

.search-button {
  padding: 5px 10px;
  font-size: 16px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
}

.table-minimalist {
    border: 2px solid darkgray;
    background-color: lightgray;
  }
 
  .table-minimalist td {
    border: 1px solid darkgray;
    padding: 0.5rem;
    text: darkgray;
  }
  .table-minimalist th {
    font-weight: bold;
    border-bottom: 1px solid darkgray;
  }

</style>

<body>

        <div class="search-bar">
            <form id="searchForm" action="{{ route('combined-data.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <input type="text" id="searchInput" name="search" class="search-input" placeholder="Search" value="{{ $searchQuery }}">
                    <button type="submit" class="search-button">Search</button>
                </div>
            </form>
        </div>


<div class="container main-container">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card custom-card">
                <div class="card-body">
                    <a href="/mefps"><h5 class="card-title"> <b>Drawings</b></h5></a>
                    
                    <p class="card-text text-center">Total Drawing : {{ $mefpsCount + $structuralCount + $asbuiltCount + $architecturalCount }}  </p>

                    <p  class="text-center">Latest Update: {{ $latestDates['structural'] }} </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card custom-card">
            <div class="card-body">
                    <a href="/inspection"><h5 class="card-title"> <b>Inspection</b></h5></a>
                    
                    <p class="card-text text-center">Total Inspection : {{ $inspectionCount  }}  </p>

                    <p  class="text-center">Latest Update: {{ $latestDates['structural'] }} </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card custom-card">
                <div class="card-body">
                    <a href="/form"><h5 class="card-title"> <b>Forms</b></h5></a>
                    
                    <p class="card-text text-center">Forms Uploaded : {{ $formCount  }}  </p>

                    <p  class="text-center">Latest Update: {{ $latestDates['form'] }} </p>
                </div>>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card custom-card">
                <div class="card-body">
                    <a href="/meeting"><h5 class="card-title"> <b>Meetings</b></h5></a>
                    
                    <p class="card-text text-center"> Total Meetings Created : {{ $meetingCount  }}  </p>

                    <p  class="text-center">Latest Update: {{ $latestDates['meeting'] }} </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card custom-card">
            <div class="card-body">
                    <a href="/report"><h5 class="card-title"> <b>Reports</b></h5></a>
                    
                    <p class="card-text text-center"> Total Report Created : {{ $reportCount  }}  </p>

                    <p  class="text-center">Latest Update: {{ $latestDates['report'] }} </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card custom-card">
            <div class="card-body">
                    <a href="/directory"><h5 class="card-title"> <b>Directory</b></h5></a>
                    
                    <p class="card-text text-center"> Total Personnel : {{ $directoryCount  }}  </p>

                    <p  class="text-center">Latest Update: {{ $latestDates['directory'] }} </p>
                </div>
            </div>
        </div>

       
    </div>
</div>


<div class="container">

  <div class="recently-added">
    <h4 class="text-center"><b>Recently Added</b></h4>
  </div>

  <div class="table-responsive">
    <table id="originalTable" class="table text-center table-minimalist">
      <thead>
        <tr>
          <th style="border: 2px solid darkgray;">Title</th>
          <th style="border: 2px solid darkgray;">Code / Type</th>
          <th style="border: 2px solid darkgray;">Location / Description</th>
          <th style="border: 2px solid darkgray;">Created At</th>
        </tr>
      </thead>
      <tbody>
        <!-- Display original table data here -->
        @foreach ($combinedData as $data)
        <tr>
          <td>{{ $data['title'] }}</td>
          <td>{{ $data['code'] }}</td>
          <td>{{ $data['location'] }}</td>
          <td>{{ $data['created_at'] }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
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
            <div class="modal-body text-center">
                @if ($searchResults->isEmpty())
                    <p>No results found.</p>
                @else
                    <table id="searchResultsTable" class="table">
                        <thead >
                            <tr>
                                <th class="text-center" >Title</th>
                                <th class="text-center">Code / Type</th>
                                <th class="text-center">Location / Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through search results and display the relevant columns -->
                            @foreach ($searchResults as $data)
                                <tr>
                                    <td>{{ $data['title'] }}</td>
                                    <td>{{ $data['code'] }}</td>
                                    <td>{{ $data['location'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>

</body>

<!-- JavaScript to trigger the modal and populate search results -->
<script>
            // When the document is ready
        $(document).ready(function() {
            // If the search input is not empty, show the modal with search results
            @if (!empty($searchQuery))
                $('#searchResultsModal').modal('show');
            @endif

            // Check if the modal is shown
            $('#searchResultsModal').on('shown.bs.modal', function () {
                // Populate the search results table with data
                var searchResults = @json($searchResults);
                var tableBody = $('#searchResultsTable tbody');
                // Clear the table body before populating it to avoid duplication
                tableBody.empty();
                $.each(searchResults, function(index, data) {
                    var row = $('<tr>').appendTo(tableBody);
                    $('<td>').text(data.title).appendTo(row);
                    $('<td>').text(data.code).appendTo(row);
                    $('<td>').text(data.location).appendTo(row);
                });
            });
        });
</script>
@endsection
