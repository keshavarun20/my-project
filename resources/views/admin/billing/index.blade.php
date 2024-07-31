@extends('layouts.admin.master')
@section('title', 'Billing and Invoice')
@section('header', 'Billing')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">Billing and Invoice</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('billing.index') }}">Billing</a></li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{{ route('billing.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="mb-3 col-xl-6">
                                                <div class="input-group mb-3 input-primary">
                                                <input type="text"id="nic" name="nic" class="form-control"placeholder="NIC">
                                                    @error('nic')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3 col-xl-6">
                                                <div class="input-group mb-3 input-primary">
                                                <input type="date"id="date" name="date" class="form-control"placeholder="Bill Date">
                                                @error('date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-xl-6">
                                                <div class="input-group mb-3 input-primary">
                                                    <input type="text"id="name" name="name" class="form-control"placeholder="Patient Name">
                                                    @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3 col-xl-6">
                                                <div class="input-group mb-3 input-primary">
                                                    <input type="text" id="mobile_number" name="mobile_number" class="form-control"placeholder="Contact Number">
                                                    @error('mobile_number')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead class ="table-primary">
                                            <tr>
                                                <th>#</th>
                                                <th>DESCRIPTION</th>
                                                <th>RATE</th>
                                                <th>QTY/HRS</th>
                                                <th>SUB TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoiceItems">
                                            <tr>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button type="button"
                                                            id="addButton"class="btn btn-success">+</button>
                                                        <button type="button" id="removeButton"
                                                            class="btn btn-danger">-</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3 input-primary">
                                                        <input type="text" id="description" name="description[]"
                                                            class="form-control" placeholder="Description" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3 input-primary">
                                                        <input type="text" id="rate" name="rate[]"
                                                            class="form-control" placeholder="RATE" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3 input-primary">
                                                        <input type="text" id="qty" name="qty[]"
                                                            class="form-control" placeholder="QTY/HRS" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3 input-primary">
                                                        <input type="total" id="subtotal" name="subtotal[]"
                                                            class="form-control" placeholder="SUB TOTAL" readonly required>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="basic-form">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <label class="me-sm-2">Payment Method</label>
                                            <select class="me-sm-2 default-select form-control wide "
                                                id="inlineFormCustomSelect" name="payment_method" required>
                                                <option selected="">Select Option</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                            </select>
                                            <div>
                                                <label class="me-sm-2">Cheque No.</label>
                                                <div class="input-group mb-3 input-primary">
                                                    <input type="text" id="cheque" name="cheque" class="form-control"
                                                        placeholder="Cheque No.">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="me-sm-2">Reference No.</label>
                                                <div class="input-group mb-3 input-primary">
                                                    <input type="text" id="reference_no" name="reference_no"
                                                        class="form-control" placeholder="Reference No.">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-responsive-sm">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>RECEIPT</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Total</td>
                                                            <td>
                                                                <div class="input-group mb-3 input-primary">
                                                                    <input type="text" id="total" name="total"
                                                                        class="form-control" placeholder="0.00" readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group input-group mb-3">
                                                                    <div class="input-group-text">Discount %</div>
                                                                    <input type="text" id="discount_percent"
                                                                        name="discount_percent" class="form-control"
                                                                        placeholder="Discount" required>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group mb-3 input-primary">
                                                                    <input type="text" id= "discount" name= "discount"
                                                                        class="form-control" placeholder="0.00" readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group input-group mb-3">
                                                                    <div class="input-group-text">Tax %</div>
                                                                    <input type="text" id= "tax_percent"
                                                                        name= "tax_percent" class="form-control"
                                                                        placeholder="Tax" required>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group mb-3 input-primary">
                                                                    <input type="text" id= "tax" name= "tax"
                                                                        class="form-control" placeholder="0.00" readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Payable</td>
                                                            <td>
                                                                <div class="input-group mb-3 input-primary">
                                                                    <input type="text" id="payable"
                                                                        name="payable"class="form-control"
                                                                        placeholder="0.00" readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
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

            function calculateSubTotal(row) {
                var rate = parseFloat(row.find('#rate').val()) || 0;
                var qty = parseFloat(row.find('#qty').val()) || 0;
                var subtotal = rate * qty;
                row.find('#subtotal').val(subtotal.toFixed(2));
            }

            function calculateTotal() {
                var total = 0
                $("#invoiceItems tr").each(function() {
                    var row = $(this);
                    var rate = parseFloat(row.find("#rate").val()) || 0;
                    var qty = parseFloat(row.find("#qty").val()) || 0;
                    total += rate * qty;
                });

                var discount_percent = parseFloat($('#discount_percent').val()) || 0;
                var tax_percent = parseFloat($('#tax_percent').val()) || 0;

                $('#total').val(total.toFixed(2));

                var discount = (total * discount_percent) / 100;
                $('#discount').val(discount.toFixed(2));

                var tax = (total * tax_percent) / 100;
                $('#tax').val(tax.toFixed(2));

                var payable = total - discount + tax;
                $('#payable').val(payable.toFixed(2));
            }

            $('#rate, #qty').on('input', function() {
                calculateSubTotal($(this).closest("tr"));
                calculateTotal();
            });

            $('#discount_percent, #tax_percent').on('input', function() {
                calculateTotal();
            });

            $(document).on("click", "#addButton", function() {
                var newRow = $(this).closest("tr").clone(true);
                newRow.find("input[type='text']").val("");
                newRow.find("#subtotal").val("0.00");
                $("#invoiceItems").append(newRow);
                calculateTotal();
            });

            $(document).on("click", "#removeButton", function() {
                $(this).closest("tr").remove();
                calculateTotal();
            });

            $('#nic').change(function() {

                var nic = $(this).val();
                if (nic) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get.patient') }}?nic=" + nic,
                        success: function(res) {
                            console.log(res);
                            if (res) {
                                $("#name").val(res['name']);
                                $("#mobile_number").val(res['mobile_number']);
                                $("#patient_id").val(res['id']);
                            } else {
                                $("#name").val('');
                                $("#mobile_number").val('');
                                $("#patient_id").val('');

                            }
                        }
                    });
                } else {
                    $("#name").val('');
                    $("#mobile_number").val('');
                }
            });

        });
    </script>
@endsection
