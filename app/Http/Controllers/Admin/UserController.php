<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Receptionist;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;

class UserController extends Controller
{
    public function index(){
        if (Auth::user()->role_id == 1) {
        $users = User::all();
        return view('admin.user.index', compact('users'));
        } else {
            abort(403, 'Unauthorized action.');
        }
        
    }
    public function create(){
        $roles = Role::all();
        $consultations=Consultation::all();
        return view('admin.user.create',compact('roles','consultations'));
    }

    public function store(UserStoreRequest $request){
        $data = $request->validated();
        //dd($data);
        $user=User::create([
            'email' => $data['email'],
            'role_id'=>$data['role_id'],
            'password' =>Hash::make($data['password']),
        ]);

        //dd($data['role_id']);
        if ($data['role_id'] == 2){
            $doctor=Doctor::create([
                'user_id'=>$user->id,
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'dob'=>$data['dob'],
                'mobile_number'=>$data['mobile_number'],
                'nic'=>$data['nic'],
                'gender'=>$data['gender'],
                'address_lane_1'=>$data['address_lane_1'],
                'address_lane_2'=>$data['address_lane_2'],
                'city'=>$data['city'],
                'consultation_id'=>$data['consultation_id'],
                'specialty'=>$data['specialty'],
                'slmc_no'=>$data['slmc_no'],
                'base_hospital'=>$data['base_hospital'],

            ]);
            //dd($request);
            if($request->input('daily_available') == 'No'){
                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                $availableDays = $request->input('available_days', []);
                $times = $request->input('times', []);

                $schedules = [];
                foreach($days as $index=>$day){
                    foreach ($availableDays as $availableDay) {
                        if($availableDay == $day){
                            $schedules[] = [
                                'doctor_id'=>$doctor->id,
                                'available_days' => $day,
                                'time' => $times[$index],
                            ];
                        }
                    }
                }
                //dd($request->input('times'));
                //dd($schedules);
                foreach ($schedules as $schedule) {
                    DoctorSchedule::create([
                        'doctor_id' => $doctor->id,
                        'available_days' => $schedule['available_days'],
                        'time' => $schedule['time']
                    ]);
                }


            }//dd()
            else {
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

                $schedules = [];
                foreach ($days as $day) {
                    $schedules[] = [
                        'available_days' => $day,
                        'time' => $request->input('time'),
                    ];
                }
            
            foreach ($schedules as $schedule) {
                DoctorSchedule::create([
                    'doctor_id' => $doctor->id,
                    'available_days' => $schedule['available_days'],
                    'time' => $schedule['time']
                ]);
                }
            }

        } else if($data['role_id'] == 3){
            Patient::create([
                'user_id'=>$user->id,
                'today_date'=>$data['today_date'],
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'dob'=>$data['dob'],
                'mobile_number'=>$data['mobile_number'],
                'nic'=>$data['nic'],
                'gender'=>$data['gender'],
                'address_lane_1'=>$data['address_lane_1'],
                'address_lane_2'=>$data['address_lane_2'],
                'city'=>$data['city'],
            ]);
            
        } else {
              Receptionist::create([
                'user_id'=>$user->id,
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'dob'=>$data['dob'],
                'mobile_number'=>$data['mobile_number'],
                'nic'=>$data['nic'],
                'gender'=>$data['gender'],
                'address_lane_1'=>$data['address_lane_1'],
                'address_lane_2'=>$data['address_lane_2'],
                'city'=>$data['city'],
            ]);
        }

        return redirect()->route('user.index',)->with('success', 'User has been created Successfully!');

    }

    public function show(User $user){
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user){
        $roles = Role::all();
        $consultations = Consultation::all();
        return view('admin.user.edit', compact('roles', 'consultations', 'user'));
    
    }


    public function update(User $user,UserUpdateRequest $request){
        $data = $request->validated();
        if($request->input('password')){
            $data['password'] = Hash::make($request->input('password'));
        }else{$data['password'] = $user->password;}

        

        if($data['role_id'] != $user->role_id){
            if ($user->role_id == 2) {
                $doctor=Doctor::where('user_id', $user->id)->first();
                $doctor->delete();
                if($data['role_id'] == 1){
                    Receptionist::create([
                        'user_id'=>$user->id,
                        'first_name'=>$data['first_name'],
                        'last_name'=>$data['last_name'],
                        'dob'=>$data['dob'],
                        'mobile_number'=>$data['mobile_number'],
                        'nic'=>$data['nic'],
                        'gender'=>$data['gender'],
                        'address_lane_1'=>$data['address_lane_1'],
                        'address_lane_2'=>$data['address_lane_2'],
                        'city'=>$data['city'],
                    ]);
                }
                else{
                    Patient::create([
                        'user_id'=>$user->id,
                        'today_date'=>$data['today_date'],
                        'first_name'=>$data['first_name'],
                        'last_name'=>$data['last_name'],
                        'dob'=>$data['dob'],
                        'mobile_number'=>$data['mobile_number'],
                        'nic'=>$data['nic'],
                        'gender'=>$data['gender'],
                        'address_lane_1'=>$data['address_lane_1'],
                        'address_lane_2'=>$data['address_lane_2'],
                        'city'=>$data['city'],
                    ]);
                }
            } 
            elseif ($user->role_id == 3) {
                $patient=Patient::where('user_id', $user->id);
                $patient->delete();
                if($data['role_id'] == 1){
                    Receptionist::create([
                        'user_id'=>$user->id,
                        'first_name'=>$data['first_name'],
                        'last_name'=>$data['last_name'],
                        'dob'=>$data['dob'],
                        'mobile_number'=>$data['mobile_number'],
                        'nic'=>$data['nic'],
                        'gender'=>$data['gender'],
                        'address_lane_1'=>$data['address_lane_1'],
                        'address_lane_2'=>$data['address_lane_2'],
                        'city'=>$data['city'],
                    ]);
                }
                else{
                Doctor::create([
                    'user_id'=>$user->id,
                    'first_name'=>$data['first_name'],
                    'last_name'=>$data['last_name'],
                    'dob'=>$data['dob'],
                    'mobile_number'=>$data['mobile_number'],
                    'nic'=>$data['nic'],
                    'gender'=>$data['gender'],
                    'address_lane_1'=>$data['address_lane_1'],
                    'address_lane_2'=>$data['address_lane_2'],
                    'city'=>$data['city'],
                    'consultation_id'=>$data['consultation_id'],
                    'specialty'=>$data['specialty'],
                    'slmc_no'=>$data['slmc_no'],
                    'base_hospital'=>$data['base_hospital'],
                ]);
                }
            } 
            else {
                $receptionist=Receptionist::where('user_id', $user->id);
                $receptionist->delete();
                if($data['role_id'] == 2){
                Doctor::create([
                    'user_id'=>$user->id,
                    'first_name'=>$data['first_name'],
                    'last_name'=>$data['last_name'],
                    'dob'=>$data['dob'],
                    'mobile_number'=>$data['mobile_number'],
                    'nic'=>$data['nic'],
                    'gender'=>$data['gender'],
                    'address_lane_1'=>$data['address_lane_1'],
                    'address_lane_2'=>$data['address_lane_2'],
                    'city'=>$data['city'],
                    'consultation_id'=>$data['consultation_id'],
                    'specialty'=>$data['specialty'],
                    'slmc_no'=>$data['slmc_no'],
                    'base_hospital'=>$data['base_hospital'],
                ]);

                }
                else{
                    Patient::create([
                        'user_id'=>$user->id,
                        'today_date'=>$data['today_date'],
                        'first_name'=>$data['first_name'],
                        'last_name'=>$data['last_name'],
                        'dob'=>$data['dob'],
                        'mobile_number'=>$data['mobile_number'],
                        'nic'=>$data['nic'],
                        'gender'=>$data['gender'],
                        'address_lane_1'=>$data['address_lane_1'],
                        'address_lane_2'=>$data['address_lane_2'],
                        'city'=>$data['city'],
                    ]);
                }
            }
            

        }
         
        else{
            if ($data['role_id'] == 2 ){
            //dd($data);
            $doctor = Doctor::where('user_id', $user->id)->first();
            $doctor->update($data);
            }
            if ($data['role_id'] == 3 ){
            $patient = Patient::where('user_id', $user->id)->first();
            $patient->update($data);
            }
            if($data['role_id'] == 1 ){
            $receptionist = Receptionist::where('user_id', $user->id)->first();
            $receptionist->update($data);
            }
        }

        $user->update($data);

        return redirect()->route('user.index')->with('updated', 'Post  details has been updated Successfully!');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('user.index')->with('deleted', 'User details has been deleted Successfully!');
    }
}
