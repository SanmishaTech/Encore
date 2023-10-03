<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', ['employees' => $employees]);
    }

    public function create()
    {
        $employees = Employee::select('id','name','designation')
                           ->get();
        return view('employees.create', ['employees' => $employees]);
    }

    public function store(Employee $employee, StoreEmployeeRequest $request) 
    {
        $input = $request->all();      
        $employee = Employee::create($input); 
        $request->session()->flash('success', 'Employee saved successfully!');
        return redirect()->route('employees.index'); 
    }
  
    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', ['employee' => $employee]);
    }

    public function update(Employee $employee, UpdateEmployeeRequest $request) 
    {
        $employee->update($request->all());
        $request->session()->flash('success', 'Employee updated successfully!');
        return redirect()->route('employees.index');
    }
  
    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();
        $request->session()->flash('success', 'Employee deleted successfully!');
        return redirect()->route('employees.index');
    }
}
