@extends('layouts.admin.master')
@section('title', 'HCC : Invoices')
@section('header', 'Invoices')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Billing</a></li>
                <li class="breadcrumb-item"><a href="{{ route('billing.invoice') }}">Invoice</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Invoice List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Patient Name</th>
                                        <th scope="col">Mobile Number</th>
                                        <th scope="col">Billing Date</th>
                                        <th scope="col">Reference Number</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->name }}</td>
                                        <td>{{ $payment->mobile_number }}</td>
                                        <td>{{ $payment->date }}</td>
                                        <td>{{ $payment->reference_no }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal{{ $payment->id }}">
                                                View Invoice
                                            </button>
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

    @foreach ($payments as $payment)
    <div class="modal fade bd-example-modal-lg" id="invoiceModal{{ $payment->id }}" tabindex="-1" aria-labelledby="invoiceModal{{ $payment->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModal{{ $payment->id }}Label">Invoice Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mt-3">
                        <div class="card-header"> <img src="/icons/new-icons/logo.png" alt="New Icon" width="150" height="150"><span></span>
                            <address>
                                <strong>Hatton Consultation Centre</strong>
                                <div>Fruit Hill</div>
                                <div>No.271, Colombo Road, Dimbulla Rd</div>
                                <div>Hatton</div>
                                <div>Phone: 0512 223 218</div>
                            </address>
                        </div>
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="mb-3 col-md-3">
                                    <strong>Bill Date :</strong>{{$payment->date}}
                                    <br>
                                    <strong>Payment Method :</strong>{{$payment->payment_method}}
                                </div>
                                <div class="mb-3 col-md-5">
                                    <strong>Reference Number :</strong>{{$payment->reference_no}}
                                    <br>
                                    <strong>Cheque No :</strong>{{$payment->cheque_no}}
                                </div>
                                <div class="mb-3 col-md-4">
                                    <strong>Patient Name :</strong>{{$payment->name}}
                                    <br>
                                    <strong>Patient Mobile Number :</strong>{{$payment->mobile_number}}
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>DESCRIPTION</th>
                                            <th>RATE</th>
                                            <th>QTY/HRS</th>
                                            <th>SUB TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payment->billings as $billing)
                                        <tr>
                                            <td>{{ $billing->description }}</td>
                                            <td>{{ $billing->rate }}</td>
                                            <td>{{ $billing->qty }}</td>
                                            <td>{{ $billing->subtotal }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5"> </div>
                            <div class="col-lg-4 col-sm-5 ms-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="right">Rs {{$payment->total}}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Discount ({{$payment->discount_percent}}%)</strong></td>
                                            <td class="right">Rs {{$payment->discount}}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Tax ({{$payment->tax_percent}}%)</strong></td>
                                            <td class="right">Rs {{$payment->tax}}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Payable</strong></td>
                                            <td class="right"><strong>Rs {{$payment->payable}}</strong><br>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
