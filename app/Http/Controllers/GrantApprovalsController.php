<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Activity;
use App\Models\GrantApproval;
use Illuminate\Http\Request;
use App\Http\Requests\GrantApprovalRequest;

class GrantApprovalsController extends Controller
{
    public function index()
    {
        $grant_approvals = GrantApproval::with(['ZonalManager', 'AreaManager', 'Manager', 'Doctor', 'Activity'])->get();
        return view('grant_approvals.index', ['grant_approvals' => $grant_approvals]);
    }

    public function create()
    {
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'MEHQ')->pluck('name', 'id');
        return view('grant_approvals.create')->with(['employees'=>$employees, 'activities'=>$activities, 'doctors'=>$doctors]);
    }

    public function store(GrantApproval $grantapproval, GrantApprovalRequest $request) 
    {
        $input = $request->all();      
        $grantapproval = GrantApproval::create($input); 
        $request->session()->flash('success', 'Grant Approval saved successfully!');
        return redirect()->route('grant_approvals.index'); 
    }
  
    public function show(GrantApproval $grantapproval)
    {
        //
    }

    public function edit(GrantApproval $grant_approval)
    {
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::select('id','name','designation')->get();
        return view('grant_approvals.edit', ['grant_approval' => $grant_approval, 'employees'=>$employees, 'doctors'=>$doctors, 'activities'=>$activities]);
    }

    public function update(GrantApproval $grantapproval, GrantApprovalRequest $request) 
    {
        $grantapproval->update($request->all());
        $request->session()->flash('success', 'Grant Approval updated successfully!');
        return redirect()->route('grant_approvals.index');
    }
  
    public function destroy(Request $request, GrantApproval $grant_approval)
    {
        $grant_approval->delete();
        $request->session()->flash('success', 'Grant Approval deleted successfully!');
        return redirect()->route('grant_approvals.index');
    }
}
