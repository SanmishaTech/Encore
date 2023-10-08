<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Activity;
use App\Models\GrantApproval;
use App\Models\GrantApprovalDetail;
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

    public function store(GrantApproval $grant_approval, GrantApprovalRequest $request) 
    {
        $input = $request->all();      
        $input['status'] = 'Open';
        $grant_approval = GrantApproval::create($input); 
        $request->session()->flash('success', 'Grant Approval saved successfully!');
        return redirect()->route('grant_approvals.index'); 
    }
  
    public function show(GrantApproval $grant_approval)
    {
        //
    }

    public function edit(GrantApproval $grant_approval)
    {
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'MEHQ')->pluck('name', 'id');
        $grant_approval->load(['GrantApprovalDetail'=>['Employee']]);
        return view('grant_approvals.edit', ['grant_approval' => $grant_approval, 'employees'=>$employees, 'doctors'=>$doctors, 'activities'=>$activities]);
    }

    public function update(GrantApproval $grant_approval, GrantApprovalRequest $request) 
    {
        $grant_approval->update($request->all());
        $request->session()->flash('success', 'Grant Approval updated successfully!');
        return redirect()->route('grant_approvals.index');
    }

    public function approval(GrantApproval $grant_approval) 
    {
        $grant_approval->status = 'ABM Approved';
        $grant_approval->update();
        $input = [];

        $input['status'] = 'Approved';
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);
        return redirect()->route('grant_approvals.index');
    }

    public function rejected(GrantApproval $grant_approval) 
    {
        $grant_approval->status = 'ABM Rejected';
        $grant_approval->update();
        $input = [];

        $input['status'] = 'Rejected';
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);

        return redirect()->route('grant_approvals.index');
    }

    public function approvalSecond(GrantApproval $grant_approval) 
    {
        $grant_approval->status = 'Approved';
        $grant_approval->update();
        $input = [];

        $input['status'] = 'RBM/ZBM Approved';
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);
        return redirect()->route('grant_approvals.index');
    }

    public function rejectedSecond(GrantApproval $grant_approval) 
    {
        $grant_approval->status = 'RBM/ZBM Rejected';
        $grant_approval->update();
        $input = [];

        $input['status'] = 'Rejected';
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);

        return redirect()->route('grant_approvals.index');
    }

    public function cancel(GrantApproval $grant_approval) 
    {
        $grant_approval->status = 'Cancel';
        $grant_approval->update();
        $input = [];

        $input['status'] = 'Cancel';
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);
        return redirect()->route('grant_approvals.index');
    }
  
    public function destroy(Request $request, GrantApproval $grant_approval)
    {
        $grant_approval->delete();
        $request->session()->flash('success', 'Grant Approval deleted successfully!');
        return redirect()->route('grant_approvals.index');
    }
}
