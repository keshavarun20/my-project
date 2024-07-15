<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function patientDemographics(Request $request)
    {
        $years = range(Carbon::now()->year, 2024);
        $months = CarbonPeriod::create('2024-01-01', '1 month', '2024-12-31');

        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);
        $action = $request->input('action');
        $patients = Patient::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        //dd(1);
        if ($action == 'Export') {
            $pdf = Pdf::loadView('admin.reports.patient_demographics_pdf', compact('patients', 'year', 'month'));
            return $pdf->stream('patient_demographics_' . $year . '_' . $month . '.pdf');
        }

        return view('admin.reports.pdreport', compact('years', 'months', 'patients', 'year', 'month'));

        
    }

    public function billingInvoice (Request $request){
        $years = range(Carbon::now()->year, 2024);
        $months = CarbonPeriod::create('2024-01-01', '1 month', '2024-12-31');

        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);
        $action = $request->input('action');

        $payments = Payment::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        if ($action == 'pdf') {
            $pdf = Pdf::loadView('admin.reports.billing_invoice_pdf', compact('payments', 'year', 'month'));
            return $pdf->stream('billing_invoice' . $year . '_' . $month . '.pdf');
        }

        return view('admin.reports.bireport', compact('years', 'months', 'payments', 'year', 'month'));
    }
}
