<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class DashboardController extends Controller
{
   public function index() {
    $totalPatients = Patient::count();                           
    if (url()->previous() !== url()->current()) {
        session()->flash('success', 'Welcome to your account, Dear');
    }

    return view('dashboard', compact('totalPatients'));
}

}
