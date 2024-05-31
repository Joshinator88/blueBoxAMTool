<?php

namespace App\Http\Controllers;

use App\Models\Strategy;
use Illuminate\Http\Request;

class StrategyController extends Controller
{
    //
    public function index($strategy)
    {
        
        return view("sharedAdminSales.edit_strategy", [
            "strategy" => Strategy::where('id', $strategy)->first()
        ]);
    }
}
