<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
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

    public function billingInvoice(Request $request)
    {
        $years = range(Carbon::now()->year, 2024);
        $months = CarbonPeriod::create('2024-01-01', '1 month', '2024-12-31');

        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);
        $action = $request->input('action');

        $payments = Payment::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        if ($action == 'Export') {
            $pdf = Pdf::loadView('admin.reports.billing_invoice_pdf', compact('payments', 'year', 'month'));
            return $pdf->stream('billing_invoice' . $year . '_' . $month . '.pdf');
        }

        return view('admin.reports.bireport', compact('years', 'months', 'payments', 'year', 'month'));
    }

    public function appointmentReport(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date', Carbon::now()->startOfMonth()));
        $endDate = Carbon::parse($request->input('end_date', Carbon::now()->endOfMonth()));
        $action = $request->input('action');

        $appointments = Appointment::whereBetween('created_at', [$startDate, $endDate])->get();

        $dailySummary = [];
        $weeklySummary = [];
        $monthlySummary = [];

        foreach ($appointments as $appointment) {
            $date = $appointment->created_at->format('Y-m-d');
            $week = $appointment->created_at->format('W');
            $month = $appointment->created_at->format('Y-m');
            $doctor = $appointment->doctor->name;

            if (!isset($dailySummary[$date][$doctor])) {
                $dailySummary[$date][$doctor] = 0;
            }
            $dailySummary[$date][$doctor]++;
            
            if (!isset($weeklySummary[$week][$doctor])) {
                $weeklySummary[$week][$doctor] = 0;
            }
            $weeklySummary[$week][$doctor]++;
            
            if (!isset($monthlySummary[$month][$doctor])) {
                $monthlySummary[$month][$doctor] = 0;
            }
            $monthlySummary[$month][$doctor]++;
        
        }


        if ($action == 'Export') {
            $pdf = Pdf::loadView('admin.reports.appointment_pdf',compact('dailySummary', 'weeklySummary', 'monthlySummary', 'startDate', 'endDate'));
            return $pdf->stream('appointment_summary_' . $startDate->format('Y_m_d') . '_to_' . $endDate->format('Y_m_d') . '.pdf');
        }

        return view('admin.reports.apreport', compact('dailySummary', 'weeklySummary', 'monthlySummary', 'startDate', 'endDate'));
        
    }

    public function yearlyRevenueReport(Request $request)
    {
        $years = range(2023, date('Y'));

        $action = $request->input('action');
        $yearlyData = [];

        foreach ($years as $year) {
            $revenue = Payment::whereYear('created_at', $year)->sum('payable');

            $yearlyData[] = [
                'year' => $year,
                'revenue' => $revenue,
            ];
        }

        if ($action == 'Export') {
            $pdf = Pdf::loadView('admin.reports.yearly_revenue_pdf', compact('yearlyData', 'year'));
            return $pdf->stream('yearly_revenue_' . date('Y') . '.pdf');
        }

        return view('admin.reports.yrreport', compact('years', 'yearlyData'));
    }
}
