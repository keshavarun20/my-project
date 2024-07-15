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
use App\Models\ActivityLog;

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
        // Validate the incoming request data
        $data = $request->validated();
        
        $admin = Auth::user();
       
        //Common Fields
        $user=User::create([
            'email' => $data['email'],
            'role_id'=>$data['role_id'],
            'password' =>Hash::make($data['password']),
        ]);

        //if the role is Doctor;
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
            
                //Doctor Schedule;
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
                    
                    foreach ($schedules as $schedule) {
                        DoctorSchedule::create([
                            'doctor_id' => $doctor->id,
                            'available_days' => $schedule['available_days'],
                            'time' => $schedule['time']
                        ]);
                    }


                }
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

            ActivityLog::create([
                'user_id' => $admin->id,
                'description' => ' Created a Doctor'. '' .'('.$doctor->name.')',
                'action_type' => 'create_doctor',
            ]);
                
        //if the Role is Patient    
        } else if($data['role_id'] == 3){
            $patient=Patient::create([
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

             ActivityLog::create([
                'user_id' => $admin->id,
                'description' => ' Created a Patient'. '' .'('.$patient->name.')',
                'action_type' => 'create_patient',
            ]);
            
        //if the role is Admin    
        } else {
             $receptionist= Receptionist::create([
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

            ActivityLog::create([
                'user_id' => $admin->id,
                'description' => ' Created a Receptionist'. '' .'('.$receptionist->name.')',
                'action_type' => 'create_receptionist',
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
        $admin = Auth::user();
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

             ActivityLog::create([
                'user_id' => $admin->id,
                'description' => ' Updated a Doctor'. '' .'('.$doctor->name.')',
                'action_type' => 'update_doctor',
            ]);
            }
            if ($data['role_id'] == 3 ){
            $patient = Patient::where('user_id', $user->id)->first();
            $patient->update($data);

            ActivityLog::create([
                'user_id' => $admin->id,
                'description' => ' Updated a Patient'. '' .'('.$patient->name.')',
                'action_type' => 'update_patient',
            ]);
            }
            if($data['role_id'] == 1 ){
            $receptionist = Receptionist::where('user_id', $user->id)->first();
            $receptionist->update($data);

            ActivityLog::create([
                'user_id' => $admin->id,
                'description' => ' Updated a Receptionist'. '' .'('.$receptionist->name.')',
                'action_type' => ' Update_receptionist',
            ]);
            }
        }

        $user->update($data);

        return redirect()->route('user.index')->with('updated', 'Post  details has been updated Successfully!');
    }

    public function destroy(User $user){

        if ($user->role->name =='Admin') {
            return redirect()->route('user.index')->with('error', 'Admin user cannot be deleted!');
        }
        $user->delete();
        return redirect()->route('user.index')->with('deleted', 'User details has been deleted Successfully!');
    }

    public function profile(User $user){
        $logs = ActivityLog::with('user')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('admin.user.profile', compact('user','logs'));
    }
    public function profilePicture(User $user ,Request $request){
        $user->clearMediaCollection('profile_picture');
        $user->addMedia($request->file('profile_picture'))->toMediaCollection('profile_picture');

        return redirect()->back()->with('success', 'Profile Picture Details Uploaded successfully.');
    }

    public function search(Request $request){
        $q=$request->search;

        $users = User::whereHas('patient', function($query) use ($q) {
            $query->where('first_name', 'like', "%$q%");
        })
        ->orWhereHas('doctor', function($query) use ($q) {
            $query->where('first_name', 'like', "%$q%");
        })
        ->orWhereHas('receptionist', function($query) use ($q) {
            $query->where('first_name', 'like', "%$q%");
        })
        ->get();



        return view('admin.user.index', compact('users','q'));

    }


}
