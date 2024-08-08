<?php

namespace App\Http\Controllers;
use PDF;
use Excel;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\Activity;
use App\Models\Employee;
use App\Exports\CDBMExport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GrantApproval;
use App\Models\ProductDetail;
use App\Mail\CDBMNotificationForAM;
use App\Mail\CDBMNotificationForZM;
use Illuminate\Support\Facades\Mail;
use App\Mail\CDBMNotificationForRoot;
use App\Models\DoctorBusinessMonitoring;
use App\Models\DoctorBusinessMonitoringDetail;
use App\Http\Requests\DoctorBusinessMonitoringRequest;

class DoctorBusinessMonitoringsController extends Controller
{
    public function index()
    {
         $query = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']]);
        $authUser = auth()->user()->roles->pluck('name')->first();
        
        $conditions = [];
        if($authUser == 'Marketing Executive'){            
            $conditions[] = ['employee_id', auth()->user()->id];
          
        } elseif($authUser == 'Area Manager'){
            // $conditions[] = ['employee_id', auth()->user()->id];
            $query->whereHas('GrantApproval', function($query){
                  $query->whereHas('Manager', function($query){
                    $query->whereHas('AreaManager', function($query){
                         $query->where('id', '=', auth()->user()->id);
                    });
                 });
             });
           
        } elseif($authUser == 'Zonal Manager'){
            // $conditions[] = ['employee_id', auth()->user()->id];
             $query->whereHas('GrantApproval', function($query){
                  $query->whereHas('Manager', function($query){
                    $query->whereHas('ZonalManager', function($query){
                         $query->where('id', '=', auth()->user()->id);
                    });
                 });
             });
        }      
        $doctor_business_monitorings = $query->whereRelation('GrantApproval', $conditions)->orderBy('id', 'DESC')->paginate(12);
        // $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])->whereRelation('GrantApproval', $conditions)->orderBy('id', 'DESC')->paginate(12);
        return view('doctor_business_monitorings.index', ['doctor_business_monitorings' => $doctor_business_monitorings]);
    }

    public function create()
    {
        $products = Product::pluck('name', 'id');
        $authUser = auth()->user()->roles->pluck('name')->first();
        $conditions = [];
        $conditions[] = ['approval_level_2', true];
        if($authUser == 'Marketing Executive'){            
            $conditions[] = ['employee_id', auth()->user()->id];
          
        }   
        $gaf_code = GrantApproval::pluck('code', 'id');
        return view('doctor_business_monitorings.create')->with(['gaf_code' => $gaf_code, 'products' => $products]);
    }

    public function store(DoctorBusinessMonitoring $doctor_business_monitoring, DoctorBusinessMonitoringRequest $request) 
    {
        $input = $request->all(); 
        $input['status'] = 'Open';
        // dd($request);
        $doctor_business_monitoring = DoctorBusinessMonitoring::create($input); 
        $data = $request->collect('product_details');
        foreach($data as $record){
            ProductDetail::create([
                'doctor_business_monitoring_id' => $doctor_business_monitoring->id,
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'avg_business_units' => $record['avg_business_units'],
                'avg_business_value' => $record['avg_business_value'],
                'exp_vol' => $record['exp_vol'],
                'exp_vol_1' => $record['exp_vol_1'],
                'exp_vol_2' => $record['exp_vol_2'],
                'exp_vol_3' => $record['exp_vol_3'],
                'exp_vol_4' => $record['exp_vol_4'],
                'exp_vol_5' => $record['exp_vol_5'],
                'exp_vol_6' => $record['exp_vol_6'],
                'total_exp_vol' => $record['total_exp_vol'],
                'total_exp_val' => $record['total_exp_val'],
                'scheme' => $record['scheme'],
            ]);            
        }   

        if(auth()->user()->roles->pluck('name')->first() == 'Marketing Executive'){
            $condition[] = ['id', '=', $doctor_business_monitoring->id];
            $print = ProductDetail::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager' => ['ZonalManager','AreaManager'], 'Doctor']]])
            ->whereRelation('DoctorBusinessMonitoring', $condition)->get();

            $email =$print[0]->DoctorBusinessMonitoring->GrantApproval->Manager->AreaManager->communication_email;
            if(!$email){
            return redirect()->route('doctor_business_monitorings.index');
            }
            Mail::to($email)
            ->send(new CDBMNotificationForAM($print));
        }
        // $print = ProductDetail::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager' => ['ZonalManager','AreaManager'], 'Doctor']]])->whereRelation('DoctorBusinessMonitoring', $condition)->get();

        $request->session()->flash('success', 'Doctor Business Monitoring saved successfully!');
        return redirect()->route('doctor_business_monitorings.index'); 
    }
  
    public function show(DoctorBusinessMonitoring $doctor_business_monitoring)
    {       
        //
    }

    public function edit(DoctorBusinessMonitoring $doctor_business_monitoring)
    {
        $doctors = Doctor::pluck('doctor_name', 'id');       
        $employees = Employee::pluck('name', 'id');
        $products = Product::pluck('name', 'id');

        $authUser = auth()->user()->roles->pluck('name')->first();
        $conditions = [];
        $conditions[] = ['approval_level_2', true];
        if($authUser == 'Marketing Executive'){            
            $conditions[] = ['employee_id', auth()->user()->id];
          
        }   
        $gaf_code = GrantApproval::pluck('code', 'id');
        return view('doctor_business_monitorings.edit', ['doctor_business_monitoring' => $doctor_business_monitoring, 'employees'=>$employees, 'doctors'=>$doctors, 'gaf_code'=>$gaf_code, 'products'=>$products]);        
    }

    public function update(DoctorBusinessMonitoring $doctor_business_monitoring, DoctorBusinessMonitoringRequest $request) 
    {
        // dd($request);
        $doctor_business_monitoring->update($request->all());
        $data = $request->collect('product_details');
        
        foreach($data as $record){
            ProductDetail::upsert([
                'id' => $record['id'] ?? null,
                'doctor_business_monitoring_id' => $doctor_business_monitoring->id,
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'avg_business_units' => $record['avg_business_units'],
                'avg_business_value' => $record['avg_business_value'],
                'exp_vol' => $record['exp_vol'],
                'exp_vol_1' => $record['exp_vol_1'],
                'exp_vol_2' => $record['exp_vol_2'],
                'exp_vol_3' => $record['exp_vol_3'],
                'exp_vol_4' => $record['exp_vol_4'],
                'exp_vol_5' => $record['exp_vol_5'],
                'exp_vol_6' => $record['exp_vol_6'],
                'total_exp_vol' => $record['total_exp_vol'],
                'total_exp_val' => $record['total_exp_val'],
                'scheme' => $record['scheme'],
            ],[
                'id'
            ]);
        }
        $request->session()->flash('success', 'Doctor Business Monitoring updated successfully!');
        return redirect()->route('doctor_business_monitorings.index');
    }
    
    // public function approval(Request $request) 
    // {
    //     $doctor_business_monitoring = DoctorBusinessMonitoring::find($request->id);
    //     $input = [];
    //     if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
    //         $doctor_business_monitoring->status = 'Level 2 Approved';
    //         $doctor_business_monitoring->approval_level_2 = true;
    //     } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
    //         $doctor_business_monitoring->status = 'Level 1 Approved';
    //         $doctor_business_monitoring->approval_level_1 = true;
    //     } else{
    //         if($doctor_business_monitoring->approval_level_1 == true){
    //             $doctor_business_monitoring->status = 'Level 2 Approved';
    //             $doctor_business_monitoring->approval_level_2 = true;
    //         } else {
    //             $doctor_business_monitoring->status = 'Level 1 Approved';
    //             $doctor_business_monitoring->approval_level_1 = true;

    //         }
    //     }  
    //     $doctor_business_monitoring->update();
    //     $input = [];
    //     $input['status'] =  $doctor_business_monitoring->status;
    //     $input['doctor_business_monitoring_id'] = $doctor_business_monitoring->id;
    //     DoctorBusinessMonitoringDetail::create($input);
    //     return redirect()->route('doctor_business_monitorings.index');
    // }
    public function approval_form(DoctorBusinessMonitoring $doctor_business_monitoring)
    {        
        $doctors = Doctor::pluck('doctor_name', 'id');       
        $employees = Employee::pluck('name', 'id');
        $products = Product::pluck('name', 'id');

        $authUser = auth()->user()->roles->pluck('name')->first();
        $conditions = [];
        $conditions[] = ['approval_level_2', true];
        if($authUser == 'Marketing Executive'){            
            $conditions[] = ['employee_id', auth()->user()->id];
          
        }   
        $gaf_code = GrantApproval::pluck('code', 'id');
        return view('doctor_business_monitorings.approval_form', ['doctor_business_monitoring' => $doctor_business_monitoring, 'employees'=>$employees, 'doctors'=>$doctors, 'gaf_code'=>$gaf_code, 'products'=>$products]); 
    }

    public function approval(DoctorBusinessMonitoring $doctor_business_monitoring) 
    {
        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $doctor_business_monitoring->status = 'Level 2 Approved';
            $doctor_business_monitoring->approval_level_2 = true;
            $doctor_business_monitoring->approval_level_1 = true;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $doctor_business_monitoring->status = 'Level 1 Approved';
            $doctor_business_monitoring->approval_level_1 = true;
        } else{
            if($doctor_business_monitoring->approval_level_1 == true){
                $doctor_business_monitoring->status = 'Level 2 Approved';
                $doctor_business_monitoring->approval_level_2 = true;
            } else {
                $doctor_business_monitoring->status = 'Level 1 Approved';
                $doctor_business_monitoring->approval_level_1 = true;
            }
        }     
        $doctor_business_monitoring->approved_on = Carbon::now();
        $doctor_business_monitoring->update();
        $input = [];
        $input['status'] =  $doctor_business_monitoring->status;
        $input['doctor_business_monitoring_id'] = $doctor_business_monitoring->id;
        DoctorBusinessMonitoringDetail::create($input);

        if(auth()->user()->roles->pluck('name')->first() == 'Area Manager'){
            $condition[] = ['id', '=', $doctor_business_monitoring->id];
            $print = ProductDetail::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager' => ['ZonalManager','AreaManager'], 'Doctor']]])
            ->whereRelation('DoctorBusinessMonitoring', $condition)->get();

            $email =$print[0]->DoctorBusinessMonitoring->GrantApproval->Manager->ZonalManager->communication_email;
            if(!$email){
            return redirect()->route('doctor_business_monitorings.index');
            }
            Mail::to($email)
            ->send(new CDBMNotificationForZM($print));
        }

        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $condition[] = ['id', '=', $doctor_business_monitoring->id];
            $print = ProductDetail::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager' => ['ZonalManager','AreaManager'], 'Doctor']]])
            ->whereRelation('DoctorBusinessMonitoring', $condition)->get();

            $email =$print[0]->DoctorBusinessMonitoring->GrantApproval->Manager->ZonalManager->communication_email;
            if(!$email){
            return redirect()->route('doctor_business_monitorings.index');
            }
            Mail::to($email)
            ->cc("ssingh@encoregroup.net")
            ->send(new CDBMNotificationForRoot($print));
        }

        return redirect()->route('doctor_business_monitorings.index');
    }

    public function rejected(DoctorBusinessMonitoring $doctor_business_monitoring) 
    {
        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $doctor_business_monitoring->status = 'Level 2 Rejected';
            $doctor_business_monitoring->approval_level_2 = false;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $doctor_business_monitoring->status = 'Level 1 Rejected';
            $doctor_business_monitoring->approval_level_1 = false;
        } else{
            if($doctor_business_monitoring->approval_level_1 == false){
                $doctor_business_monitoring->status = 'Level 2 Rejected';
                $doctor_business_monitoring->approval_level_2 = false;
            } else {
                $doctor_business_monitoring->status = 'Level 1 Rejected';
                $doctor_business_monitoring->approval_level_1 = false;
            }
        }     
        $doctor_business_monitoring->update();
        $input = [];
        $input['status'] =  $doctor_business_monitoring->status;
        $input['doctor_business_monitoring_id'] = $doctor_business_monitoring->id;
        DoctorBusinessMonitoringDetail::create($input);
        return redirect()->route('doctor_business_monitorings.index');
    }

    public function approvalSecond(DoctorBusinessMonitoring $doctor_business_monitoring) 
    {
        $doctor_business_monitoring->status = 'Approved';
        $doctor_business_monitoring->update();
        $input = [];
        $input['status'] = 'Zonal Manager Approved';
        $input['doctor_business_monitoring_id'] = $doctor_business_monitoring->id;
        DoctorBusinessMonitoringDetail::create($input);
        return redirect()->route('doctor_business_monitorings.index');
    }

    public function rejectedSecond(DoctorBusinessMonitoring $doctor_business_monitoring) 
    {
        $doctor_business_monitoring->status = 'Zonal Manager Rejected';
        $doctor_business_monitoring->update();
        $input = [];

        $input['status'] = 'Rejected';
        $input['doctor_business_monitoring_id'] = $doctor_business_monitoring->id;
        DoctorBusinessMonitoringDetail::create($input);
        return redirect()->route('doctor_business_monitorings.index');
    }

    public function destroy(Request $request, DoctorBusinessMonitoring $doctor_business_monitoring)
    {
        $doctor_business_monitoring->delete();
        $request->session()->flash('success', 'Doctor Business Monitoring deleted successfully!');
        return redirect()->route('doctor_business_monitorings.index');
    }

    public function report()
    {
        $doctors = Doctor::select('id', 'doctor_name')->OrderBy('doctor_name', 'ASC')->get();
        $zonalManagers = Employee::select('e1.*')->from('employees as e1')->join('employees as e2','e1.id', '=', 'e2.reporting_office_1')->distinct()->get();
        return view('doctor_business_monitorings.report', compact('doctors','zonalManagers'));
    }

    public function reportCDBM(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $doctor = $request->doctor;
        $zonalManager = $request->zonalManager;
        return Excel::download(new CDBMExport($from_date, $to_date, $doctor,$zonalManager), 'CDBM_report.xlsx');
        
        // $doctor_business_monitorings = ProductDetails::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']],'Doctor']])->whereRelation('DoctorBusinessMonitoring', $condition)->get();
        // // $doctor_business_monitorings->load(['ProductDetails'=>['Products']]);
        // // dd($doctor_business_monitorings);
        // $pdf = PDF::loadView('doctor_business_monitorings.print', compact('doctor_business_monitorings','doctors', 'employees', 'products'));        
        // $pdf->setPaper('A4', 'landscape');
        // $pdf->render();              
        // return $pdf->stream("CDBM -" . date("dmY") .".pdf");         
    }

    public function search(Request $request){
        // $query = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']]);
        $authUser = auth()->user()->roles->pluck('name')->first();
        
        $data = $request->input('search');
        $status = $request->input('status');

        if($authUser == 'Marketing Executive'){        
          
            $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
            ->where(function ($query) use ($data) {
            $query->whereHas('GrantApproval', function ($query) use ($data) {
           $query->whereHas('Manager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
           })
           ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
           })
           ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
             })
            ->orWhere('code', 'like', "%$data%");
         });
           })
           ->where('status', 'like', "%$status%")
           ->whereRelation('GrantApproval', 'employee_id', auth()->user()->id)
           ->paginate(12);

        } elseif($authUser == 'Area Manager'){               
            $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
            ->where(function ($query) use ($data) {
            $query->whereHas('GrantApproval', function ($query) use ($data) {
           $query->whereHas('Manager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
           })
           ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
           })
           ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
             })
             ->orWhere('code', 'like', "%$data%");
         });
           })
           ->where('status', 'like', "%$status%")
           ->whereHas('GrantApproval.Manager', function($query) use ($data){
                 $query->where('reporting_office_2', auth()->user()->id);
           })
          ->paginate(12);

        
        } elseif($authUser == 'Zonal Manager'){
        
            $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
            ->where(function ($query) use ($data) {
            $query->whereHas('GrantApproval', function ($query) use ($data) {
           $query->whereHas('Manager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
           })
           ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
           })
           ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
             })
             ->orWhere('code', 'like', "%$data%");
         });
           })
           ->where('status', 'like', "%$status%")
            ->whereHas('GrantApproval.Manager', function($query) use ($data){
            $query->where('reporting_office_1', auth()->user()->id);
            })
          ->paginate(12);

        }
        else{       
            $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
            ->where(function ($query) use ($data) {
            $query->whereHas('GrantApproval', function ($query) use ($data) {
           $query->whereHas('Manager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
           })
           ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
           })
           ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
               $query->where('name', 'like', "%$data%");
             })
             ->orWhere('code', 'like', "%$data%");
         });
           })
           ->where('status', 'like', "%$status%")
          ->paginate(12);

        }
       
      return view('doctor_business_monitorings.index', ['doctor_business_monitorings'=>$doctor_business_monitorings]);

    }


    public function searchStatus(Request $request){
        // $query = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']]);
        $authUser = auth()->user()->roles->pluck('name')->first();
        
        $data = $request->input('status');

        if($authUser == 'Marketing Executive'){        
          
            $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
            ->where('status', 'like', "%$data%")
            ->whereRelation('GrantApproval', 'employee_id', auth()->user()->id)
            ->paginate(12);

        } elseif($authUser == 'Area Manager'){               
            $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
            ->where('status', 'like', "%$data%")
            ->whereHas('GrantApproval.Manager', function($query) use ($data){
                 $query->where('reporting_office_2', auth()->user()->id);
           })
          ->paginate(12);

        
        } elseif($authUser == 'Zonal Manager'){
        
            $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
            ->where('status', 'like', "%$data%")
            ->whereHas('GrantApproval.Manager', function($query) use ($data){
            $query->where('reporting_office_1', auth()->user()->id);
            })
          ->paginate(12);

        }
        else{       
            $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
            ->where('status', 'like', "%$data%")
            ->paginate(12);

        }
       
      return view('doctor_business_monitorings.index', ['doctor_business_monitorings'=>$doctor_business_monitorings]);

    }

}
