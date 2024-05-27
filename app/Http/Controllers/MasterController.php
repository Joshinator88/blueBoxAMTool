<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all(); // Get all categories for the form
        return view('parents.index', compact('parents', 'categories'));
    }
    
    public function search(Request $request)
    {
        $search = $request['parentSearch'];
        $parents = Master::with('category') // Eager load the category relationship
            ->where('name', 'like', '%' . $search . '%')
            ->get();
        $categories = Category::all(); // Get all categories for the form
        return view('parents.index', compact('parents', 'categories'));
    }

    public function store(Request $request)
    {
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
        $parent = Master::findOrFail($id);
        $categories = Category::all();
        return view('parents.edit', compact('parent', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $parent = Master::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'partner_id' => 'required',
            'sales_support' => 'required',
            'sales_administrator' => 'required',
        ]);

        $parent->update([
            'name' => $request['name'],
            'category_id' => $request->input('category_id'),
            'partner_id' => $request->input('partner_id'),
            'sales_support' => $request->input('sales_support'),
            'sales_administrator' => $request->input('sales_administrator'),
        ]);

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully');
    }

    public function destroy($id)
    {
        $parent = Master::findOrFail($id);
        $parent->delete();
        return redirect()->route('parents.index')->with('success', 'Parent deleted successfully');
    }
}
