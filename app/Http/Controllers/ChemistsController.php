<?php

namespace App\Http\Controllers;
use Excel;
use App\Imports\ImportChemists;
use App\Models\Chemist;
use App\Http\Requests\ChemistRequest;
use App\Models\Employee;
use App\Models\Territory;
use Illuminate\Http\Request;

class ChemistsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chemists = Chemist::with(['Employee', 'Territory'])->orderBy('id', 'desc')->paginate(12);
        // dd($chemists);
        return view('chemists.index', compact('chemists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $employees = Employee::pluck('employee_code', 'id');
        $employees = Employee::pluck('name', 'id');
        $territories = Territory::pluck('name', 'id');
        return view('chemists.create', compact('employees', 'territories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChemistRequest $request)
    {
        $input = $request->all();      
        $Chemist = Chemist::create($input); 
        $request->session()->flash('success', 'Chemist saved successfully!');
        return redirect()->route('chemists.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Chemist $chemist)
    {
        return $chemist;  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chemist $chemist)
    {
        $employees = Employee::pluck('name', 'id');
        $territories = Territory::pluck('name', 'id');
        return view('chemists.edit', compact('chemist', 'territories', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChemistRequest $request, Chemist $chemist)
    {
        $chemist->update($request->all());
        $request->session()->flash('success', 'Chemist updated successfully!');
        return redirect()->route('chemists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chemist $chemist)
    {
        $chemist->delete();
        $request->session()->flash('success', 'Chemist deleted successfully!');
        return redirect()->route('chemists.index');
    }

    public function import()
    {
        return view('chemists.import');
    }

    public function importChemistsExcel(Request $request)
    {      
        try {
            Excel::import(new ImportChemists, $request->file);
            $request->session()->flash('success', 'Excel imported successfully!');
            return redirect()->route('chemists.index');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function search(Request $request){
        $data = $request->input('search');
        $chemists = Chemist::with(['Employee', 'Territory'])->where('chemist', 'like', "%$data%")->paginate(12);
        return view('chemists.index', ['chemists'=>$chemists]);
    }
}
