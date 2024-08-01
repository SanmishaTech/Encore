<?php

namespace App\Http\Controllers;
use Excel;
use App\Imports\ImportQualifications;
use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Http\Requests\QualificationRequest; 

class QualificationsController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::orderBy('id', 'desc')->paginate(12);
        return view('qualifications.index', ['qualifications' => $qualifications]);
    }

    public function create()
    {
        return view('qualifications.create');
    }

    public function store(Qualification $qualification, QualificationRequest $request) 
    {
        $input = $request->all();      
        $qualification = Qualification::create($input); 
        $request->session()->flash('success', 'Qualification saved successfully!');
        return redirect()->route('qualifications.index'); 
    }
  
    public function show(Qualification $qualification)
    {
        //
    }

    public function edit(Qualification $qualification)
    {
        return view('qualifications.edit', ['qualification' => $qualification]);
    }

    public function update(Qualification $qualification, QualificationRequest $request) 
    {
        $qualification->update($request->all());
        $request->session()->flash('success', 'Qualification updated successfully!');
        return redirect()->route('qualifications.index');
    }
  
    public function destroy(Request $request, Qualification $qualification)
    {
        $qualification->delete();
        $request->session()->flash('success', 'Qualification deleted successfully!');
        return redirect()->route('qualifications.index');
    }

    public function import()
    {
        return view('qualifications.import');
    }

    public function importQualificationExcel(Request $request)
    {      
        try {
            Excel::import(new ImportQualifications, $request->file);
            $request->session()->flash('success', 'Excel imported successfully!');
            return redirect()->route('qualifications.index');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    } 

    public function search(Request $request){
        $data = $request->input('search');
        $qualifications = Qualification::where('name', 'like', "%$data%")->paginate(12);
        // $employees = Employee::with(['users'])->orderBy('id', 'desc')->paginate(12);

        return view('qualifications.index', ['qualifications'=>$qualifications]);
    }

}
