<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'description' => 'nullable',
        ]);

        Category::create([
            'name' => $request['category_name'],
            'description' => $request['description']
        ]);

        return redirect()->route('parents.index')->with('success', 'Category added successfully');
    }
}
