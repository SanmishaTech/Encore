<?php

namespace App\Http\Controllers;
use PDF;
use Excel;
use App\Exports\GAFExport;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
        $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->orderBy('code', 'DESC')->get();
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $manager = auth()->user()->id;
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            ->where('employee_id', $manager)
            ->orderBy('code', 'DESC')->get();
          
        } elseif($authUser == 'Area Manager'){
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
                ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
                ->orderBy('code', 'DESC')->get();
            // dd(auth()->user()->id); exit;

           
        } elseif($authUser == 'Zonal Manager'){
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->where('approval_level_1', true)
            ->orderBy('code', 'DESC')->get();           
        }        
        return view('grant_approvals.index', ['grant_approvals' => $grant_approvals]);
    }

    public function create()
    {
        $authUser = auth()->user()->roles->pluck('name')->first();       
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
            
        }
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
        $grant_approval->load(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']);
        return $grant_approval;
    }

    public function edit(GrantApproval $grant_approval)
    {
        
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $grant_approval->load(['GrantApprovalDetail'=>['Employee']]);

        $authUser = auth()->user()->roles->pluck('name')->first();   
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
            // dd($doctors);
        }
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
        // dd($request); exit;
        $grant_approval = GrantApproval::find($request->id);
        $input = [];
        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $grant_approval->status = 'Level 2 Approved';
            $grant_approval->approval_level_2 = true;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $grant_approval->status = 'Level 1 Approved';
            $grant_approval->approval_level_1 = true;
        } else{
            if($grant_approval->approval_level_1 == true){
                $grant_approval->status = 'Level 2 Approved';
                $grant_approval->approval_level_2 = true;
            } else {
                $grant_approval->status = 'Level 1 Approved';
                $grant_approval->approval_level_1 = true;

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
            $grant_approval->status = 'Level 2 Rejected';
            $grant_approval->approval_level_2 = false;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $grant_approval->status = 'Level 1 Rejected';
            $grant_approval->approval_level_1 = false;
        } else{
            if($grant_approval->approval_level_1 == false){
                $grant_approval->status = 'Level 2 Rejected';
                $grant_approval->approval_level_2 = false;
            } else {
                $grant_approval->status = 'Level 1 Rejected';
                $grant_approval->approval_level_1 = false;

            }
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

    public function report()
    {
        return view('grant_approvals.report');
    }

    public function reportPDF(Request $request)
    {    
        // $condition = [];
        // $fromDate = '';
        // $toDate = '';
        // if(isset($request->from_date)){
        //     $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date);
        //     $condition[] = ['date_of_issue', '>=' , $fromDate];
        // }        

        // if(isset($request->to_date)){
        //     $toDate = Carbon::createFromFormat('Y-m-d', $request->to_date);
        //     $condition[] = ['date_of_issue', '<=' , $toDate];
        // }
        
        // $doctor = Doctor::all();
        // $grant_approval= GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->where($condition)->get();
        // $pdf = PDF::loadView('grant_approvals.print', compact('grant_approval','doctor','fromDate','toDate'));        
        // $pdf->setPaper('A4', 'landscape');
        // $pdf->render();              
        // return $pdf->stream("GAF -" . date("dmY") .".pdf");     
        
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        return Excel::download(new GAFExport($from_date, $to_date), 'GAF_report.xlsx');
    }

    public function approval_form(GrantApproval $grant_approval)
    {        
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $grant_approval->load(['GrantApprovalDetail'=>['Employee']]);

        $authUser = auth()->user()->roles->pluck('name')->first();   
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_2', auth()->user()->id)->pluck('doctor_name', 'id');
            // dd($doctors);
        }
        return view('grant_approvals.approval_form', ['grant_approval' => $grant_approval, 'employees'=>$employees, 'doctors'=>$doctors, 'activities'=>$activities]);
    }

    public function getGrantApprovalData($id)
    {
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Area Manager'){
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
                ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
                ->where('id', $id)
                ->orderBy('code', 'DESC')
                ->get();
        } 
        return $grant_approvals;
    }
}
