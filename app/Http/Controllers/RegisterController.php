<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\VarDumper\VarDumper;

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
        $color = "text-red-600";
        $message = $request['email'] . " is already used by another user";
        if (!User::where('email', $request['email'])->first()) {
            User::create([
                'name' => $request['firstname'],
                'last_name' => $request['lastname'],
                'gender_id' => $request['gender'],
                'role_id' => $request['role'],
                'email' => $request['email'],
                'password' => Hash::make('Welcome!123')
            ]);
            $message = $request['firstname'] . " has been registered";
            $color = "text-green-600";
        }
        return view(
            'admin.registerUser', 
            [
            'roles' => Role::all(),
            'genders' => Gender::all(),
            'message' => $message,
            'color' => $color
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
                "user" => User::where('id', $request['userId'])->first(),
                'roles' => Role::all(),
                'genders' => Gender::all()
            ]);
        } else if (isset($request['update'])) {
            // here we check if the email adress that is requested, is unique or if the user that we want to update has this email,
            // if so we update the user. otherwise this update is not allowed
            if (!User::where('email', $request['email'])->first() || User::where('email', $request['email'])->first() == User::where('id', $request['userId'])->first()) {
                DB::table('users')
                    ->where('id', $request['userId'])
                    ->update([
                        'name' => $request['name'],
                        'last_name' => $request['lastname'],
                        'role_id' => $request['role'],
                        'gender_id' => $request['gender'],
                        'email' => $request['email'],
                        'phone' => $request['phone']
                    ]);
                    return view("admin.updateUser", [
                        "user" => User::where('id', $request['userId'])->first(),
                        'roles' => Role::all(),
                        'genders' => Gender::all()
                    ]);
            // if the email the user wants to change to is already in use, we go back to the view page and return an error message
            } else {
                return view("admin.updateUser", [
                    "user" => User::where('id', $request['userId'])->first(),
                    'roles' => Role::all(),
                    'genders' => Gender::all(),
                    'error' => "That email is already used by another user"
                ]);
            }
        } else if (isset($request['resetPassword'])) {
            DB::table('users')
                ->where('id', $request['userId'])
                ->update([
                    'password' => Hash::make("W3lc0m3123")
                ]);
            return view("admin.updateUser", [
                "user" => User::where('id', $request['userId'])->first(),
                'roles' => Role::all(),
                'genders' => Gender::all(),
                'message' => "Password of this user is updated"
            ]);
        }
    }
}
