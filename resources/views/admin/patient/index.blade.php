@extends('layouts.admin.master')
@section('title','Patients Lists')
@section('header','Patients')
@section('content')

<div class="content-body">
    <div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('patient.index') }}">Patients Lists</a></li>
        </ol>
    </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Patients Lists</h4>
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
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Registered On</th>
                                    <th scope="col">Status</th>
                                    <th><strong></strong></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($patients as $patient )
                                <tr>
                                    <td>{{$patient->id}}</td>
                                    <td>{{$patient->name}}</td>
                                    <td>{{$patient->user->email}}</td>
                                    <td>{{$patient->mobile_number}}</td>
                                    <td>{{$patient->today_date}}</td>
                                    <td>
                                         @php
                                            $isActive = true;
                                            if ($patient->lastAppointment) {
                                                $daysSinceAppointment = Carbon\Carbon::parse($patient->lastAppointment->date)->diffInDays(now());
                                                if ($daysSinceAppointment > 100) {
                                                    $isActive = false;
                                                }
                                            }
                                        @endphp
                                        @if ($isActive)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown ms-auto">
                                            <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                    </g>
                                                </svg>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('patient.profile',$patient->id )}}" class="dropdown-item">
                                                    <i class="fa fa-user-circle text-primary me-2"></i>View profile
                                                </a>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
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
            var profileRoute = "{{ route('patient.profile', ':id') }}";
            if (filterType && filterValue) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('patient.filter') }}?filterType=" + filterType + "&filterValue=" + filterValue,
                    success: function(res) {
                        $('#data-table tbody').empty();
                        if (res.length > 0) {
                            $.each(res, function(index, data) {
                                profileRoute = profileRoute.replace(':id', data.id);
                                var isActive = true;
                                if (data.lastAppointment) {
                                    var daysSinceAppointment = moment().diff(moment(data.lastAppointment.date), 'days');
                                    if (daysSinceAppointment > 100) {
                                        isActive = false;
                                    }
                                }
                                var status = isActive ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                                $('#data-table tbody').append('<tr>' +
                                    '<td>' + data.id + '</td>' +
                                    '<td>' + data.name + '</td>' +
                                    '<td>' + data.email + '</td>' +
                                    '<td>' + data.mobile_number + '</td>' +
                                    '<td>' + data.today_date + '</td>' +
                                    '<td>' + status + '</td>' +
                                    '<td><div class="dropdown ms-auto"><a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a><ul class="dropdown-menu dropdown-menu-end"><a href="' + profileRoute + '" class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i>View profile</a></ul></div></td>' +
                                    '</tr>');
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
                        '<td>' + data.email + '</td>' +
                        '<td>' + data.mobile_number + '</td>' +
                        '<td>' + data.today_date + '</td>' +
                        '<td>' + status + '</td>' +
                        '<td><div class="dropdown ms-auto"><a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a><ul class="dropdown-menu dropdown-menu-end"><a href="' + profileRoute + '" class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i>View profile</a></ul></div></td>' +
                        '</tr>');
                });
            }
        });
    });
</script>
@endsection

