<?php

namespace App\Http\Controllers;
use Excel;
use App\Imports\ImportTerritories;
use Illuminate\Http\Request;
use App\Models\Territory;
  
use App\Http\Requests\TerritoryRequest;    

class TerritoriesController extends Controller
{
    public function index()
    {
        $territories = Territory::orderBy('id', 'desc')->get();
        return view('territories.index', ['territories' => $territories]);
    }

    public function create()
    {
        return view('territories.create');
    }

    public function store(Territory $territory, TerritoryRequest $request) 
    {
        $input = $request->all();      
        $territory = Territory::create($input); 
        $request->session()->flash('success', 'Territory saved successfully!');
        return redirect()->route('territories.index'); 
    }
  
    public function show(Territory $territory)
    {
        //
    }

    public function edit(Territory $territory)
    {
        return view('territories.edit', ['territory' => $territory]);
    }

    public function update(Territory $territory, TerritoryRequest $request) 
    {
        $territory->update($request->all());
        $request->session()->flash('success', 'Territory updated successfully!');
        return redirect()->route('territories.index');
    }
  
    public function destroy(Request $request, Territory $territory)
    {
        $territory->delete();
        $request->session()->flash('success', 'Territory deleted successfully!');
        return redirect()->route('territories.index');
    }

    public function import()
    {
        return view('territories.import');
    }

    public function importTerritoryExcel(Request $request)
    {      
        try {
            $import = Excel::import(new ImportTerritories, $request->file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->route('territories.index')->with('data', $failures);
        }
        return redirect()->route('territories.index');
    } 
}
