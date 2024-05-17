<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Gender;
use App\Models\User;
use RuntimeException;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class RegisterController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role->role == "admin") {
            return view(
                'admin.registerUser', 
                [
                'roles' => Role::all(),
                'genders' => Gender::all()
                ]
            );
        }         
        return view("dashboard");
    }

    public function create(Request $request)
    {
        // var_dump($request);
        User::create([
            'name' => $request['firstname'],
            'last_name' => $request['lastname'],
            'gender_id' => $request['gender'],
            'role_id' => $request['role'],
            'email' => $request['email'],
            'password' => Hash::make('Welcome!123')
        ]);

        return view(
            'admin.registerUser', 
            [
            'roles' => Role::all(),
            'genders' => Gender::all()
            ]
        );
    }
}
