<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Category $category, StoreCategoryRequest $request) 
    {
        $input = $request->all();      
        $category = Category::create($input); 
        $request->session()->flash('success', 'Category saved successfully!');
        return redirect()->route('categories.index'); 
    }
  
    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    public function update(Category $category, UpdateCategoryRequest $request) 
    {
        $category->update($request->all());
        $request->session()->flash('success', 'Category updated successfully!');
        return redirect()->route('categories.index');
    }
  
    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        $request->session()->flash('success', 'Category deleted successfully!');
        return redirect()->route('categories.index');
    }
}
