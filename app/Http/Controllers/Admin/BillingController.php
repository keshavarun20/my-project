<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

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
}
