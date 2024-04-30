<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class DashboardController extends Controller
{
   public function index() {
    $totalPatients = Patient::count();
    //dd(env('APP_URL'));                         
    if (url()->previous() == env('APP_URL').'/login') {
        session()->flash('success', 'Welcome to your account, Dear');
    }

    return view('dashboard', compact('totalPatients'));
}

}
