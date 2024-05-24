<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use App\Models\Category;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('parentSearch');
        $parents = ParentModel::with('category') // Eager load the category relationship
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
            'partners' => 'required',
            'sales_support' => 'required',
            'sales_administrator' => 'required',
        ]);

        // Ensure partners is properly formatted as a JSON array
        $partners = explode(',', $request->input('partners'));

        ParentModel::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'partners' => json_encode($partners),
            'sales_support' => $request->input('sales_support'),
            'sales_administrator' => $request->input('sales_administrator'),
        ]);

        return redirect()->route('parents.index');
    }


    public function edit($id)
    {
        $parent = ParentModel::findOrFail($id);
        $categories = Category::all();
        return view('parents.edit', compact('parent', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $parent = ParentModel::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'partners' => 'required',
            'sales_support' => 'required',
            'sales_administrator' => 'required',
        ]);

        // Ensure partners is properly formatted as a JSON array
        $partners = explode(',', $request->input('partners'));

        $parent->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'partners' => json_encode($partners),
            'sales_support' => $request->input('sales_support'),
            'sales_administrator' => $request->input('sales_administrator'),
        ]);

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully');
    }

    public function destroy($id)
    {
        $parent = ParentModel::findOrFail($id);
        $parent->delete();
        return redirect()->route('parents.index')->with('success', 'Parent deleted successfully');
    }
}
