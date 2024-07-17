@extends('layouts.admin.master')
@section('title', 'Yearly Revenue Report')
@section('header', 'Yearly Revenue Report')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Yearly Revenue Report</h4>
                    </div>
                    <div class="card-body">
                        <form method="get">
                            <input class="btn btn-success" type="submit" name="action" value="Generate">
                            <input class="btn btn-primary" type="submit" name="action" value="Export">
                        </form>
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($yearlyData as $yearData)
                            <tr>
                                <td>{{ $yearData['year'] }}</td>
                                <td>{{ $yearData['revenue'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
@endsection
