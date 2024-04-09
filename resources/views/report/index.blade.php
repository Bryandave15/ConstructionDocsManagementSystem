
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
    <h2 style="margin: 0; margin-right: 200px">REPORTS</h2>
    <!-- Headline "FORMS" --> 
    <a class="btn btn-primary"  href="http://127.0.0.1:8000/report-add-form"><b>Add Report</b></a>
        <!-- Search input field -->
    <input type="text" id="searchInput" class="form-control" placeholder="Search... "style="width: 300px;">
</div>

<div class="table-responsive">
<table class="table table-striped" >
<thead>
        <tr>
            <th style="border-bottom: 2px solid black;">report_title</th>
            <th style="border-bottom: 2px solid black;">report_type</th>
            <th style="border-bottom: 2px solid black;">Description</th>
            <th style="border-bottom: 2px solid black;">created_by</th>
            <th style="border-bottom: 2px solid black;">Attachment</th>
            <th style="border-bottom: 2px solid black;">Actions</th>
        </tr>
    </thead>
<tbody>

@foreach ($report_data as $d)
<tr >

    <td>{{ $d->report_title }}</td>
    <td>{{ $d->report_type }}</td> 
    <td>{{ $d->description }}</td> 
    <td>{{ $d->created_by }}</td> 
   

    <td>
         <a href="{{ asset('uploads/'.$d->attachment) }}" download>
             <i class="fas fa-download"></i> {{ $d->attachment }}
        </a>
    </td>
    <td>
        
        <button id="butEdit" onclick="processEdit({{ $d->report_id }})" class="btn btn-success">Update</button>
        <button id="butDelete" onclick="processDelete({{ $d->report_id }})" class="btn btn-danger">Delete</button>
        <button onclick="downloadAttachment('{{ $d->attachment }}')" class="btn btn-primary">Download</button>
        
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
    window.location.href = '/report-update-form/'+pId 
}

function processDelete(pId)
{
    let text = "Are you sure to delete this record?";
    if (confirm(text))
    {
        $.ajax({
            type: "POST",
            url: "{{ url('report-del') }}",
            data: {
                _token: '{{ csrf_token() }}',
                report_id: pId
            },
            success: function(response){
                if (response.success) {
                    // alert("Structural record deleted successfully!");
                    window.location.href = '/report';
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

