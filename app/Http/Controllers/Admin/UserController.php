<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Consultation;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Models\Consultations;

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
        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id'=>$data['role_id'],
            'password' =>Hash::make($data['password']),
        ]);

        $doctor=Doctor::create([
            'user_id'=>$user->id
        ]);

        return redirect()->route('user.index')->with('success', 'User has been created Successfully!');

    }

    public function show(User $user){
        return view('admin.user.show', compact('user'));
    }
}
