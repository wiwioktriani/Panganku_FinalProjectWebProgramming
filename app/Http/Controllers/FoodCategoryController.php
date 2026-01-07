<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    public function index()
    {
        $categories = FoodCategory::latest()->paginate(15);
        return view('food_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('food_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        FoodCategory::create($request->only('name', 'description'));

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    public function edit(FoodCategory $category)
    {
        return view('food_categories.edit', compact('category'));
    }

    public function update(Request $request, FoodCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->only('name', 'description'));

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(FoodCategory $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}