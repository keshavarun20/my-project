<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Receptionist;
use App\Http\Requests\Admin\UserStoreRequest;

class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return view('admin.user.index',compact('users'));
    }
    public function create(){
        $roles = Role::all();
        $consultations=Consultation::all();
        return view('admin.user.create',compact('roles'),compact('consultations'));
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
            Doctor::create([
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
        } else if($data['role_id'] == 3){
            Patient::create([
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
}
