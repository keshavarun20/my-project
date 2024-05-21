<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VitalSignController extends Controller
{
    public function index()
    {

        return view('patient.vitalsigns.index');
    }
}
