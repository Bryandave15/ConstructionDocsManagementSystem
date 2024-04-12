
@extends('layouts.app')
@section('content')



@if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
@endif

@if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
@endif


<div style="display: flex; justify-content: space-around; border-bottom: 2px solid black; padding-bottom: 2px;">
    <h2 style="margin: 0; margin-right: 200px">Inspection Test Result</h2>
    <!-- Headline "FORMS" --> 
    <a class="btn btn-primary"  href="/inspection-add-form"><b>Add Inspection Result</b></a>
        <!-- Search input field -->
    <input type="text" id="searchInput" class="form-control" placeholder="Search... "style="width: 300px;">
</div>

<div class="table-responsive text-center">
<table class="table table-striped text-center" >
<thead>
        <tr>
            <th style="border-bottom: 2px solid black;">Inspection Title</th>
            <th style="border-bottom: 2px solid black;">Code</th>
            <th style="border-bottom: 2px solid black;">Type</th>
            <th style="border-bottom: 2px solid black;">Category</th>
            <th style="border-bottom: 2px solid black;">Date</th>
            <th style="border-bottom: 2px solid black;">Description</th>
            <th style="border-bottom: 2px solid black;">Remarks</th>
            <th style="border-bottom: 2px solid black;">Attachment</th>

            <th style="border-bottom: 2px solid black;">Actions</th>
        </tr>
    </thead>
<tbody>

@foreach ($inspection_data as $d)
<tr >

    <td>{{ $d->inspection_title }}</td>
    <td>{{ $d->inspection_code }}</td>
    <td>{{ $d->inspection_type }}</td> 
    <td>{{ $d->inspection_category }}</td> 
    <td>{{ $d->inspection_date }}</td> 
    <td>{{ $d->description }}</td> 
    <td>{{ $d->remarks }}</td> 

 
    <td>
         <a href="{{ asset('uploads/'.$d->attachment) }}" download>
             <i class="fas fa-download"></i> {{ $d->attachment }}
        </a>
    </td>
    <td>
        <div> 
        <button id="butEdit" onclick="processEdit({{ $d->inspection_id }})" class="btn btn-success"> Update </button></div>
        <div> 
        <button id="butDelete" onclick="processDelete({{ $d->inspection_id }})" class="btn btn-danger"> Delete   </button></div>
        <div> 
        <button onclick="downloadAttachment('{{ $d->attachment }}')" class="btn btn-primary">Download</button></div>
        
    </td> 
    
</tr>    
@endforeach
</tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

<script>

$(document).ajaxStart(function() {
    $('#status_request').show();
});
 
$(document).ajaxStop(function() {
    $('#status_request').hide();
});

document.addEventListener('DOMContentLoaded', function () {
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function () {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        table = document.querySelector('.table');
        tr = table.getElementsByTagName('tr');

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName('td');
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                        break;
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }
    });
    $('#searchInput').on('keyup', function () {
        var filter = $(this).val().toUpperCase();
        $('.table tbody tr').each(function () {
            var rowText = $(this).text().toUpperCase();
            $(this).toggle(rowText.indexOf(filter) > -1);
        });
    });
});
 


function processEdit(pId)
{
    window.location.href = '/inspection-update-form/'+pId 
}

function processDelete(pId)
{
    let text = "Are you sure to delete this record?";
    if (confirm(text))
    {
        $.ajax({
            type: "POST",
            url: "{{ url('inspection-del') }}",
            data: {
                _token: '{{ csrf_token() }}',
                inspection_id: pId
            },
            success: function(response){
                if (response.success) {
                    // alert("Structural record deleted successfully!");
                    window.location.href = '/inspection';
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    } 
}
function downloadAttachment(filename) {
        var link = document.createElement('a');
        link.setAttribute('href', '/uploads/' + filename);
        link.setAttribute('download', filename);
        link.click();
    }


</script>


@endsection


