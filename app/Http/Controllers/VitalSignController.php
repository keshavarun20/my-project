<?php

namespace App\Http\Controllers;

use App\Http\Requests\VitalSignStoreRequest;
use App\Models\VitalSign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class VitalSignController extends Controller
{
    public function index()
    {
        $rbs= VitalSign::whereNotNull('rbs')->latest()->value('rbs');
        $hr = VitalSign::whereNotNull('heart_rate')->latest()->value('heart_rate');
        $bps = VitalSign::whereNotNull('blood_pressure_systolic')->latest()->value('blood_pressure_systolic');
        $bpd = VitalSign::whereNotNull('blood_pressure_diastolic')->latest()->value('blood_pressure_diastolic');
        $rr = VitalSign::whereNotNull('respiratory_rate')->latest()->value('respiratory_rate');
        $spo2 = VitalSign::whereNotNull('spo2')->latest()->value('spo2');
        return view('patient.vitalsigns.index', compact('rbs','hr','bps','bpd','rr','spo2'));
    }

    public function store(VitalSignStoreRequest $request)
    {
        $data = $request->validated();
        $patientId = Auth::user()->patient->id;

        VitalSign::create([
            'patient_id' => $patientId,
            'rbs' => $data['rbs'],
            'blood_pressure_systolic' => $data['blood_pressure_systolic'],
            'blood_pressure_diastolic' => $data['blood_pressure_diastolic'],
            'heart_rate' => $data['heart_rate'],
            'respiratory_rate' => $data['respiratory_rate'],
            'spo2' => $data['spo2'],
        ]);

        return redirect()->route('vital.index',)->with('success', 'User has been created Successfully!');
    }

    public function getRbsData()
    {

        $rbsData = VitalSign::whereNotNull('rbs')->orderBy('created_at', 'desc')->pluck('rbs');
        return response()->json($rbsData);
    }

    public function getHrData()
    {

        $hrData = VitalSign::whereNotNull('heart_rate')->orderBy('created_at', 'desc')->pluck('heart_rate');
        return response()->json($hrData);
    }
    public function getBpsData()
    {

        $bpsData = VitalSign::whereNotNull('blood_pressure_systolic')->orderBy('created_at', 'desc')->pluck('blood_pressure_systolic');
        return response()->json($bpsData);
    }

    public function getBpdData()
    {

        $bpsData = VitalSign::whereNotNull('blood_pressure_diastolic')->orderBy('created_at', 'desc')->pluck('blood_pressure_diastolic');
        return response()->json($bpsData);
    }
    public function getRrData()
    {

        $rrData = VitalSign::whereNotNull('respiratory_rate')->orderBy('created_at', 'desc')->pluck('respiratory_rate');
        return response()->json($rrData);
    }
    public function getSpo2Data()
    {

        $sp02Data = VitalSign::whereNotNull('spo2')->orderBy('created_at', 'desc')->pluck('spo2');
        return response()->json($sp02Data);
    }
}
