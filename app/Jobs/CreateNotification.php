<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $date = Carbon::now()->addDay()->toDateString();

        $appointments = Appointment::whereDate('date', $date)->get();

        foreach ($appointments as $appointment) {
            $patient = User::find($appointment->patient_id);
            $doctor = User::find($appointment->doctor_id);

            $title = "Appointment Reminder: " . $appointment->date;

            Notification::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'title' => $title,
                'message' => "You have an upcoming appointment with" . " " . $appointment->doctor->name . " tomorrow.",
                'doctor_message' => "You have an appointment with " . " " . $appointment->patient->name . " tomorrow.",
            ]);
        }
    }
}
