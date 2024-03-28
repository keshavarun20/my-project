<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BillingStoreRequest;
use App\Models\Billing;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BillingController extends Controller
{
     public function billing()
    {
         return view('admin.billing.index');
    }

    
    public function calculateTotals(Request $request)
    {
        $patient = Patient::where('nic',$request->nic)->first();
        return response()->json($patient);
    }

    public function store(BillingStoreRequest $request,)
    {
    $data = $request->validated();
    $patient = Patient::where('nic', $data['nic'])->first();
    $descriptions = $request->input('description', []);
    $rates = $request->input('rate', []);
    $qtys = $request->input('qty', []);
    $subtotals = $request->input('subtotal', []);

    $payment=Payment::create([
            'patient_id'=>$patient->id,
            'payment_method' => $data['payment_method'],
            'nic' => $data['nic'],
            'date' => $data['date'],
            'name' => $data['name'],
            'mobile_number' => $data['mobile_number'],
            'cheque_no' => $data['cheque'],
            'reference_no' => $data['reference_no'],
            'total' => $data['total'],
            'discount_percent' => $data['discount_percent'],
            'discount' => $data['discount'],
            'tax_percent' => $data['tax_percent'],
            'tax' => $data['tax'],
            'payable' => $data['payable'],
        ]);

    foreach ($descriptions as $key => $description) {
        Billing::create([
            'payment_id'=>$payment->id,
            'description' => $description,
            'rate' => $rates[$key],
            'qty' => $qtys[$key],
            'subtotal' => $subtotals[$key],
            
        ]);
    }

    return redirect()->route('admin.billing.invoice')->with('success', 'Billing information saved successfully.');
    }

    public function invoice()
    {
        $payments = Payment::all();

       return view('admin.billing.invoice', compact('payments'));
    }

    public function generatePdf(Payment $payment){

    
    $payment = Payment::where('id', $payment->id)->first();
    //dd($payment->billings);

    $data = [
        'payment' => $payment,
    ];

    $pdf = PDF::loadView('admin.billing.invoice-pdf', $data);
    return $pdf->download($payment->name.'-invoice'.'.pdf');

}
    
}
