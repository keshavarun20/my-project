@extends('layouts.admin.master')
@section('title','Appointment Lists')
@section('header','Appointments')
@section('content')

<div class="content-body">
    <div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('patient.appointment') }}">Appointment Lists</a></li>
        </ol>
    </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Appointment Lists</h4>
                   <div class="btn-group">
                        <select class="form-control" id="filterSelect">
                            <option value="filter">Filter</option>
                            <option value="name">Filter by Name</option>
                            <option value="date">Filter by Date</option>
                        </select>
                        <div id="filterByName" class="dropdown-item-filter d-none">
                            <input id="filterValueName" type="text" class="form-control filter-input" placeholder="Enter name">
                        </div>
                        <div id="filterByDate" class="dropdown-item-filter d-none">
                            <input id="filterValueDate" type="date" class="form-control filter-input">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Token Number</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($patients as $patient)
                                @foreach ($patient->appointments as $appointment)
                                <tr>
                                    <td>{{$appointment->id}}</td>
                                    <td>{{$appointment->name}}</td>
                                    <td>{{$appointment->mobile_number}}</td>
                                    <td>{{$appointment->token_number}}</td>
                                    <td>{{$appointment->date}}</td>
                                </tr>
                                @endforeach
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        var originalData = {!! json_encode($patients) !!};

        $('#filterSelect').change(function() {
            var filterType = $(this).val();
            if (filterType === 'name') {
                $('#filterByName').removeClass('d-none');
                $('#filterByDate').addClass('d-none');
            } else if (filterType === 'date') {
                $('#filterByName').addClass('d-none');
                $('#filterByDate').removeClass('d-none');
            } else {
                $('#filterByName').addClass('d-none');
                $('#filterByDate').addClass('d-none');
            }
        });

        $('.filter-input').on('input', function() {
            var filterType = $('#filterSelect').val();
            var filterValue = $(this).val();
            if (filterType && filterValue) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('patient.filter1') }}?filterType=" + filterType + "&filterValue=" + filterValue,
                    success: function(res) {
                        $('#data-table tbody').empty();
                        if (res.length > 0) {
                            $.each(res, function(index, data) {
                                $('#data-table tbody').append('<tr>' +
                                    '<td>' + data.id + '</td>' +
                                    '<td>' + data.name + '</td>' +
                                    '<td>' + data.mobile_number + '</td>' +
                                    '<td>' + data.token_number + '</td>' +
                                    '<td>' + data.date + '</td>' + '</tr>');
                            });
                        } else {
                            $('#data-table tbody').append('<tr><td colspan="7">No result</td></tr>');
                        }
                    }
                });
            } else {
                $('#data-table tbody').empty();
                $.each(originalData, function(index, data) {
                    $('#data-table tbody').append('<tr>' +
                        '<td>' + data.id + '</td>' +
                        '<td>' + data.name + '</td>' +
                        '<td>' + data.mobile_number + '</td>' +
                        '<td>' + data.token_number + '</td>' +
                        '<td>' + data.date + '</td>' + '</tr>');

                });
            }
        });
    });
</script>
@endsection

