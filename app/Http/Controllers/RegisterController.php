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
    private function defaultRegisterView()
    {
    }
    //
    public function index()
    {
        if (Auth::check()) {
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
        return view('auth.login');
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

    public function search(Request $request)
    {
        if (isset($request['userSearch'])) {
            return view('admin.registerUser', [
                'searchedUsers' => User::query()
                                    ->WhereRaw(
                                        "MATCH (name, last_name, email) AGAINST (? IN BOOLEAN MODE)",
                                        $request['userSearch']
                                    )
                                    ->get(),
                'roles' => Role::all(),
                'genders' => Gender::all()
            ]);
        }
        return view(
            'admin.registerUser', 
            [
            'roles' => Role::all(),
            'genders' => Gender::all()
            ]
        );
    }

    public function update(Request $request)
    {
        if (isset($request["deleteUser"])) {
            User::where('id', $request['userId'])->delete();
            return view(
                'admin.registerUser', 
                [
                'roles' => Role::all(),
                'genders' => Gender::all()
                ]
            );
        } else if (isset($request['editUser'])) {
            return view("admin.updateUser", [
                "user" => User::where('id', $request['userId'])->first()
            ]);
        }
    }
}
