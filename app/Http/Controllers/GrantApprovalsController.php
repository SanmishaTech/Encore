<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Activity;
use App\Models\GrantApproval;
use App\Models\GrantApprovalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GrantApprovalRequest;
use App\Models\GrantApproval\codeGenerate;

class GrantApprovalsController extends Controller
{
    public function index()
    {
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Managing Executive'){
            $manager = auth()->user()->id;
            $grant_approvals = GrantApproval::with(['ZonalManager', 'AreaManager', 'Manager', 'Doctor', 'Activity'])
            ->where('employee_id_1', $manager)
            ->get();
            return view('grant_approvals.index', ['grant_approvals' => $grant_approvals]);
        } elseif($authUser == 'Area Manager'){
            $abm = auth()->user()->id;
            $grant_approvals = GrantApproval::with(['ZonalManager', 'AreaManager', 'Manager', 'Doctor', 'Activity'])
            ->where('employee_id_2', $abm)
            ->get();
            return view('grant_approvals.index', ['grant_approvals' => $grant_approvals]);
        } elseif($authUser == 'Zonal Manager'){
            $rbm = auth()->user()->id;
            $grant_approvals = GrantApproval::with(['ZonalManager', 'AreaManager', 'Manager', 'Doctor', 'Activity'])
            ->where('employee_id_3', $rbm)
            ->where('status', "Area Manager Approved")
            ->where('approved_by_area', true)
            ->get();
            return view('grant_approvals.index', ['grant_approvals' => $grant_approvals]);
        }
        $grant_approvals = GrantApproval::with(['ZonalManager', 'AreaManager', 'Manager', 'Doctor', 'Activity'])->get();
        return view('grant_approvals.index', ['grant_approvals' => $grant_approvals]);
    }

    public function create()
    {
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Managing Executive'){
            $manager = auth()->user()->id;
            $doctors = Doctor::pluck('doctor_name', 'id');
            $activities = Activity::pluck('name', 'id');
            $employees = Employee::where('designation', 'Managing Executive')
                                    ->where('id', $manager)
                                    ->pluck('name', 'id');
            return view('grant_approvals.create')->with(['employees'=>$employees, 'activities'=>$activities, 'doctors'=>$doctors]);
        }
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'Managing Executive')->pluck('name', 'id');
        return view('grant_approvals.create')->with(['employees'=>$employees, 'activities'=>$activities, 'doctors'=>$doctors]);
    }

    public function store(GrantApproval $grant_approval, GrantApprovalRequest $request) 
    {
        $input = $request->all();      
        $input['status'] = 'Open';
        if(empty($grant_approval->code)){
            $code = new GrantApproval();  
            $grant_approval->code = $code->codeGenerate();
        }
        $grant_approval = GrantApproval::create($input); 
        $request->session()->flash('success', 'Grant Approval saved successfully!');
        return redirect()->route('grant_approvals.index'); 
    }
  
    public function show(GrantApproval $grant_approval)
    {
        $grant_approval->load(['ZonalManager', 'AreaManager', 'Manager', 'Doctor']);
        return $grant_approval;
    }

    public function edit(GrantApproval $grant_approval)
    {
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'Managing Executive')->pluck('name', 'id');
        $grant_approval->load(['GrantApprovalDetail'=>['Employee']]);
        return view('grant_approvals.edit', ['grant_approval' => $grant_approval, 'employees'=>$employees, 'doctors'=>$doctors, 'activities'=>$activities]);
    }

    public function update(GrantApproval $grant_approval, GrantApprovalRequest $request) 
    {
        if(empty($grant_approval->code)){
            $code = new GrantApproval();  
            $grant_approval->code = $code->codeGenerate();
        }
        $grant_approval->update($request->all());
        $request->session()->flash('success', 'Grant Approval updated successfully!');
        return redirect()->route('grant_approvals.index');
    }

    public function approval(Request $request) 
    {
        $grant_approval = GrantApproval::find($request->id);
        $input = [];
        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $grant_approval->status = 'Zonal Manager Approved';
            $grant_approval->approved_by_zonal = true;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $grant_approval->status = 'Area Manager Approved';
            $grant_approval->approved_by_area = true;
        } else{
            if($grant_approval->approved_by_area = true){
                $grant_approval->status = 'Zonal Manager Approved';
            }
        }     
        $grant_approval->approval_amount = $request->amount;    
        $grant_approval->update();
        $input = [];
        $input['status'] =  $grant_approval->status;
        $input['amount'] = $grant_approval->approval_amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);
        return redirect()->route('grant_approvals.index');
    }

    public function rejected(GrantApproval $grant_approval) 
    {
        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $grant_approval->status = 'Zonal Manager Rejected';            
            $grant_approval->approved_by_zonal = false;
        } else {
            $grant_approval->status = 'Area Manager Rejected';            
            $grant_approval->approved_by_area = false;
        }   
        $grant_approval->update();
        $input = [];
        $input['status'] =  $grant_approval->status;
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
        $input['status'] = 'Zonal Manager Approved';
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);
        return redirect()->route('grant_approvals.index');
    }

    public function rejectedSecond(GrantApproval $grant_approval) 
    {
        $grant_approval->status = 'Zonal Manager Rejected';
        $grant_approval->update();
        $input = [];

        $input['status'] = 'Rejected';
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
