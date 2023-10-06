<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Qualification;
use App\Models\Category;
use App\Models\Territory;

use App\Http\Requests\DoctorRequest;

class DoctorsController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', ['doctors' => $doctors]);
    }

    public function create()
    {
        $qualifications = Qualification::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $territories = Territory::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');
        return view('doctors.create',compact('qualifications','categories','territories','employees'));
    }

    public function store(Doctor $doctor, DoctorRequest $request) 
    {
        $input = $request->all(); 
        $doctor = Doctor::create($input); 
        $request->session()->flash('success', 'Doctor saved successfully!');
        return redirect()->route('doctors.index'); 
    }
  
    public function show(Doctor $doctor)
    {       
        return $doctor;  
    }

    public function edit(Doctor $doctor)
    {
        $qualifications = Qualification::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $territories = Territory::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');
        return view('doctors.edit', [
            'doctor' => $doctor,
            'qualifications' => $qualifications,
            'categories' => $categories,
            'territories' => $territories,
            'employees' => $employees,
        ]);
    }

    public function update(Doctor $doctor, DoctorRequest $request) 
    {
        $doctor->update($request->all());
        $request->session()->flash('success', 'Doctor updated successfully!');
        return redirect()->route('doctors.index');
    }
  
    public function destroy(Request $request, Doctor $doctor)
    {
        $doctor->delete();
        $request->session()->flash('success', 'Doctor deleted successfully!');
        return redirect()->route('doctors.index');
    }
}
