<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee\EmployeeCode;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['users'])->orderBy('id', 'desc')->get();
        return view('employees.index', ['employees' => $employees]);
    }

    public function create()
    {
        $employees = Employee::select('id','name','designation')->get();
        return view('employees.create', ['employees' => $employees]);
    }

    public function store(Employee $employee, EmployeeRequest $request) 
    {
        $input = $request->all();    

        $input['name'] = $request->name;
        $input['password'] = Hash::make($request->password);
        $input['active'] = true;        
        $user = User::create($input);     
        $user->syncRoles($input['designation']); 
        $employee = $user->Employee()->create($input);
        $request->session()->flash('success', 'Employee saved successfully!');
        return redirect()->route('employees.index'); 
    }
  
    public function show(Employee $employee)
    {        
        $abm = Employee::select('id','name')
                        ->where('reporting_office_1',$employee->id)
                        ->where('designation','Area Manager')
                        ->get();
        return $abm;
    }
    
    public function getReportingOfficer3(Employee $employee)
    {
        $mehq = Employee::select('id','name')
                        ->where('reporting_office_2',$employee->id)
                        ->where('designation','Managing Executive')
                        ->get();
        return $mehq;
    }

    public function getEmployees(Employee $employee)
    {
        $employee->load(['ZonalManager', 'AreaManager']);
        return $employee;
    }

    public function edit(Employee $employee)
    {
        $employee_list = Employee::select('id','name','designation')->get();
        return view('employees.edit', ['employee' => $employee, 'employee_list' => $employee_list]);
    }

    public function update(Employee $employee, EmployeeRequest $request) 
    {
        $input = $request->all();
        $user = User::find($employee->id);
        $employee->update($request->all());        
       
        if ($user === null)
        {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->active = true;
            $employee->User()->save($user);
        }
        else
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'active' => true,
            ]);
        }
        $user->syncRoles($input['designation']);
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
