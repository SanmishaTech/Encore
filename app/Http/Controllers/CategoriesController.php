<?php

namespace App\Http\Controllers;

use Excel;
use App\Imports\ImportCategories;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(12);
        return view('categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Category $category, CategoryRequest $request) 
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

    public function update(Category $category, CategoryRequest $request) 
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

    public function import()
    {
        return view('categories.import');
    }

    public function importCategoriesExcel(Request $request)
    {      
        try {
            Excel::import(new ImportCategories, $request->file);
            $request->session()->flash('success', 'Excel imported successfully!');
            return redirect()->route('categories.index');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    } 

    public function search(Request $request){
        $data = $request->input('search');
        $categories = Category::where('name', 'like', "%$data%")->paginate(12);
        return view('categories.index', ['categories'=>$categories]);
    }

}
