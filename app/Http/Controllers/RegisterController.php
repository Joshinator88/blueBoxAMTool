<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RuntimeException;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class RegisterController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role->role == "admin") {
            return view('admin.registerUser');
        }         
        return view("dashboard");
    }
}
