@extends('layouts.admin.master')
@section('title', 'Billing & Invoice Report')
@section('header', 'Billing & Invoice Report')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Billing and Invoice Report</h4>
                    </div>
                    <div class="card-body">
                        <form method="get">
                            <select name="year" class="btn btn-outline-info ml-2">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        {{ request()->input('year') == $year ? 'selected' : '' }}>{{ $year }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="month" class="btn btn-outline-info ml-2">
                                @foreach ($months as $month)
                                    <option value="{{ date('m', strtotime($month)) }}"
                                        {{ request()->input('month') == date('m', strtotime($month)) ? 'selected' : '' }}>
                                        {{ date('F', strtotime($month)) }}</option>
                                @endforeach
                            </select>
                            <input class="btn btn-success" type="submit" name="action" value="Generate">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">Export</button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" type="submit" name="action" value="pdf"><i class="las la-file-pdf"></i>PDF</button>
                            </div>
                        </form>
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>Patinet Name</th>
                                    <th>Invoice Date</th>
                                    <th>Total Amount</th>
                                    <th>Paymnet Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->name }}</td>
                                        <td>{{ $payment->date }}</td>
                                        <td>{{ $payment->payable }}</td>
                                        <td>{{ $payment->payment_method }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
