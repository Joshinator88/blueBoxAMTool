<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleMasterController extends Controller
{
    //
    public function index($id)
    {
        return view('sharedAdminSales.singleparent' , [
            "parent" => Master::with("users", "category", "partners")->find($id),
            "colleague" => User::where('id', '!=', Auth::user()->id)->first(),
        ]);
    }
}
