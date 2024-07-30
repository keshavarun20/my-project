<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function deleteAllNotifications(Request $request)
    {

        $user = Auth::user();
        if ($user->patient) {
            $userId = $user->patient->id; // Get ID from the patients table
        } elseif ($user->doctor) {
            $userId = $user->doctor->id;

            Notification::where('patient_id', $userId)->orWhere('doctor_id', $userId)->delete();

            return redirect()->back()->with('status', 'All notifications deleted successfully.');
        }
    }
}
