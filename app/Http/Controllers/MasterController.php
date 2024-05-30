<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Master;
use App\Models\Partner;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Node\Inline\Newline;

class MasterController extends Controller
{
    public function index()
    {
        if (Auth::user()->role->role == "sales") {
            return view('sales.home');
        } else if (Auth::user()->role->role == "admin") {
            $partners = Partner::all();
            $users = User::where('role_id', 2)->get();
            $parents = Master::with('category')->get(); // Eager load the category relationship
            $categories = Category::all(); // Get all categories for the form
            return view('parents.index', compact('parents', 'categories', 'users', 'partners'));
        }
        return redirect()->route('dashboard');
    }

   
    public function search(Request $request)
    {
        if (Auth::user()->role->role !== "admin") {
            return redirect()->route('dashboard');
        }
        $users = User::where('role_id', 2)->get();
        $search = $request['parentSearch'];
        $parents = Master::with('category') // Eager load the category relationship
            ->where('name', 'like', '%' . $search . '%')
            ->get();
        $categories = Category::all(); // Get all categories for the form
        // dd($parents);
        return view('parents.index', compact('parents', 'categories', 'users'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role->role !== "admin") {
            return redirect()->route('dashboard');
        }
        
        $master = Master::create([
            'name' => $request['name'],
            'category_id' => $request['category_id'],
        ]);
        $master->users()->attach(User::where("role_id", 2)->find($request['salesOne']));
        if ($request['salesOne'] !== $request['salesTwo']) {
            $master->users()->attach(User::where("role_id", 2)->find($request['salesTwo']));
        }
        
        foreach (Partner::all() as $partner) {
            if (isset($request[$partner->id])) {
                $master->partners()->attach($partner);
            }
        }

        return redirect()->route('parents.index');
    }

    // this method gets called when the user actiualy presses de edit putton on the update page
    public function edit(Request $request)
    {
        if (Auth::user()->role->role !== "admin") {
            return redirect()->route('dashboard');
        }


        $roleId = Role::where("role", "sales")->first();
        $parent = Master::with("users", "category", 'partners')->find($request['parentId']);
        $selectedPartners = $parent->partners->pluck("id")->toArray();
        $categories = Category::all();
        $users = User::where("role_id", $roleId->id)->get();
        $partners = Partner::all();
        $newPartners = [];

        // running through all partners to check what checkboxes are selected
        foreach ($partners as $partner) {
            // this means the checkbox is ticked
            if (isset($request[$partner->id])) {
                array_push($newPartners, $partner->id);
            }
        }
         // update the parents name and category
         $parent->update([
            'name' => $request['name'],
            "category_id" => $request['category_id']
         ]);

        // adding the new users to the master and removing the ones that are not relavant anymore
        $parent->users()->sync($request['salesOne'], $request['salesTwo']);
        // add the new partners to the master and removing the ones that are not relavant anymore
        $parent->partners()->sync($newPartners);
        return view('parents.edit', compact('parent', 'categories', 'partners', "selectedPartners", 'users'));
    }

    public function update(Request $request)
    {
        // check if logged in user is authorized to execute this action
        if (Auth::user()->role->role !== "admin") {
            return redirect()->route('dashboard');
        }
        // check if the user wants to go to the edit page of this parent
        if (isset($request['editParent'])) {
                $roleId = Role::where("role", "sales")->first();
                $master = Master::with("users", "category", 'partners')->find($request['parentId']);
            
            return view("parents.edit", [
                "parent" => $master,
                "users" => User::where("role_id", $roleId->id)->get(),
                "partners" => Partner::all(),
                "selectedPartners" => $master->partners->pluck("id")->toArray(),
                "categories" => Category::all()
                ]);
        // check if the user wants to delete this parent
        } else if (isset($request['deleteParent'])) {
            $parent = Master::findOrFail($request['parentId']);
            $parent->delete();
            return redirect()->route('parents.index')->with('success', 'Parent deleted successfully');
        }
    }
}
