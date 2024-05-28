<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Master;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Node\Inline\Newline;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role->role !== "admin") {
            return redirect()->route('dashboard');
        }
        $parents = Master::with('category')->get(); // Eager load the category relationship
        $categories = Category::all(); // Get all categories for the form
        return view('parents.index', compact('parents', 'categories'));
    }
    
    public function search(Request $request)
    {
        if (Auth::user()->role->role !== "admin") {
            return redirect()->route('dashboard');
        }
        $search = $request['parentSearch'];
        $parents = Master::with('category') // Eager load the category relationship
            ->where('name', 'like', '%' . $search . '%')
            ->get();
        $categories = Category::all(); // Get all categories for the form
        return view('parents.index', compact('parents', 'categories'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role->role !== "admin") {
            return redirect()->route('dashboard');
        }
        $request->validate([
            'name' => 'required',
            'category_id' => 'required', // Validate category_id
            'partner_id' => 'required',
            'sales_support' => 'required',
            'sales_administrator' => 'required',
        ]);

        $partners = 

        Master::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'partner_id' => $request->input('partner_id'),
            'sales_support' => $request->input('sales_support'),
            'sales_administrator' => $request->input('sales_administrator'),
        ]);

        return redirect()->route('parents.index');
    }

    public function edit($id)
    {
        if (Auth::user()->role->role !== "admin") {
            return redirect()->route('dashboard');
        }
        $parent = Master::findOrFail($id);
        $categories = Category::all();
        return view('parents.edit', compact('parent', 'categories'));
    }

    public function update(Request $request)
    {
        // check if logged in user is authorized to execute this action
        if (Auth::user()->role->role !== "admin") {
            return redirect()->route('dashboard');
        }
        // check if the user wants to go to the edit page
        if (isset($request['editParent'])) {
            // $request->validate([
            //     'name' => 'required',
            //     'category_id' => 'required',
            //     'partner_id' => 'required',
            //     'sales_support' => 'required',
            //     'sales_administrator' => 'required',
            // ]);
    
            // $parent->update([
            //     'name' => $request['name'],
            //     'category_id' => $request->input('category_id'),
            //     'partner_id' => $request->input('partner_id'),
            //     'sales_support' => $request->input('sales_support'),
            //     'sales_administrator' => $request->input('sales_administrator'),
            // ]);
                $roleId = Role::where("role", "sales")->first();
            
            return view("parents.edit", [
                "parent" => Master::with("users", "category")->find($request['parentId']),
                "users" => User::where("role_id", $roleId->id)->get()
                ]);
        // check if the user wants to delete this parent
        } else if (isset($request['deleteParent'])) {
            $parent = Master::findOrFail($request['parentId']);
            $parent->delete();
            return redirect()->route('parents.index')->with('success', 'Parent deleted successfully');
        }
    }
}
