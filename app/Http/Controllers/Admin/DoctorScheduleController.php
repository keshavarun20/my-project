<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DoctorScheduleUpdateRequest;

class DoctorScheduleController extends Controller
{
    public function index(){
        $doctors=Doctor::all();
        return view('admin.doctorschedule.index',compact('doctors'));
        
    }

    public function edit(Doctor $doctor){
        
        return view('admin.doctorschedule.edit', compact('doctor'));
    
    }
    
    public function update(Doctor $doctor, DoctorScheduleUpdateRequest $request){
        
        //dd($request);  
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $availableDays = $request->input('available_days', []);
        $times = $request->input('times', []);
        $schedules = [];
        $dailyAvailable = $request->input('daily_available');

        if ($dailyAvailable == 'No') {
            DoctorSchedule::where('doctor_id', $doctor->id)->delete();
            foreach($days as $index=>$day){
                    foreach ($availableDays as $availableDay) {
                        if($availableDay == $day){
                            $schedules[] = [
                                'doctor_id' => $doctor->id,
                                'available_days' => $day,
                                'time' => $times[$index],
                            ];
                        }
                    }
                }
                foreach ($schedules as $schedule) {
                    DoctorSchedule::updateOrCreate([
                        'doctor_id' => $doctor->id,
                        'available_days' => $schedule['available_days'],
                        'time' => $schedule['time']
                    ]);
                }
        }
        if ($dailyAvailable == 'Yes') {
            DoctorSchedule::where('doctor_id', $doctor->id)->delete();
            foreach ($days as $day) {
                        $schedules[] = [
                            'available_days' => $day,
                            'time' => $request->input('time'),
                        ];
                    }
                
                foreach ($schedules as $schedule) {
                    DoctorSchedule::updateOrCreate([
                        'doctor_id' => $doctor->id,
                        'available_days' => $schedule['available_days'],
                        'time' => $schedule['time']
                    ]);
                }
        }
        return redirect()->route('dschedule.index',)->with('updated', 'Doctor Schedule Updated Successfully!');
    }
}