<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StockistRequest;
use App\Models\Stockist;
use App\Models\Employee;


class StockistsController extends Controller
{
    public function index()
    {
        $stockists = Stockist::with(['ZonalManager', 'AreaManager', 'Manager'])->get();
        return view('stockists.index', ['stockists' => $stockists]);
    }

    public function create()
    {
        $employees = Employee::select('id','name','designation')->get();
        return view('stockists.create')->with(['employees'=>$employees]);
    }

    public function store(Stockist $stockist, StockistRequest $request) 
    {
        $input = $request->all();      
        $stockist = Stockist::create($input); 
        $request->session()->flash('success', 'Stockist saved successfully!');
        return redirect()->route('stockists.index'); 
    }
  
    public function show(Stockist $stockist)
    {
        //
    }

    public function edit(Stockist $stockist)
    {
        $employees = Employee::select('id','name','designation')->get();
        return view('stockists.edit', ['stockist' => $stockist, 'employees'=>$employees]);
    }

    public function update(Stockist $stockist, StockistRequest $request) 
    {
        $stockist->update($request->all());
        $request->session()->flash('success', 'Stockist updated successfully!');
        return redirect()->route('stockists.index');
    }
  
    public function destroy(Request $request, Stockist $stockist)
    {
        $stockist->delete();
        $request->session()->flash('success', 'Stockist deleted successfully!');
        return redirect()->route('stockists.index');
    }
}