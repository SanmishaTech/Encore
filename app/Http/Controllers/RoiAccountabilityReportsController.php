<?php
namespace App\Http\Controllers;
use Excel;
use App\Exports\RARExport;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\RoiAccountabilityReportDetail;
use App\Models\GrantApproval;
use App\Models\RoiAccountabilityReport;
use Illuminate\Http\Request;
use App\Http\Requests\RoiAccountabilityReportRequest;

class RoiAccountabilityReportsController extends Controller
{
    public function index()
    {
        // $roi_accountability_reports = RoiAccountabilityReport::orderBy('id', 'desc')->get();
        // return view('roi_accountability_reports.index', compact('roi_accountability_reports'));
        $query = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]]);
        $authUser = auth()->user()->roles->pluck('name')->first();
        $conditions = [];
        if($authUser == 'Marketing Executive'){            
            $conditions[] = ['employee_id', auth()->user()->id];
          
        } elseif($authUser == 'Area Manager'){
            $query->whereHas('GrantApproval', function($query){
                $query->whereHas('Manager', function($query){
                  $query->whereHas('AreaManager', function($query){
                       $query->where('id', '=', auth()->user()->id);
                  });
               });
           });
           
        } elseif($authUser == 'Zonal Manager'){
            $query->whereHas('GrantApproval', function($query){
                $query->whereHas('Manager', function($query){
                  $query->whereHas('ZonalManager', function($query){
                       $query->where('id', '=', auth()->user()->id);
                  });
               });
           });
        }       
        $roi_accountability_reports = $query->whereRelation('GrantApproval', $conditions)->orderBy('id', 'DESC')->paginate(12);
        return view('roi_accountability_reports.index', ['roi_accountability_reports' => $roi_accountability_reports]);
    }

    public function create()
    {
        $years = range(2023, 2028);
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $products = Product::pluck('name', 'id');
        $authUser = auth()->user()->roles->pluck('name')->first();
        $conditions = [];
        $conditions[] = ['approval_level_2', true];
        if($authUser == 'Marketing Executive'){            
            $conditions[] = ['employee_id', auth()->user()->id];
          
        }   
        $gaf_code = GrantApproval::where($conditions)->pluck('code', 'id');
        return view('roi_accountability_reports.create')->with(['gaf_code' => $gaf_code, 'products' => $products, 'years'=>$years, 'months'=>$months]);
    }

    public function store(RoiAccountabilityReport $roi_accountability_report, RoiAccountabilityReportRequest $request) 
    {
        // dd($request);
        $input = $request->all();
        $roi_accountability_report = RoiAccountabilityReport::create($input); 
        $data = $request->collect('product_details');
        
        foreach($data as $record){
            
            RoiAccountabilityReportDetail::create([
                'roi_accountability_report_id' => $roi_accountability_report->id,
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'month' => $record['month'],
                'act_vol' => $record['act_vol'],
                'act_val' => $record['act_val'],
                'scheme' => $record['scheme'],
            ]);            
        }   
        $request->session()->flash('success', 'Roi Accountability Report saved successfully!');
        return redirect()->route('roi_accountability_reports.index'); 
    }
  
    public function show(RoiAccountabilityReport $roi_accountability_report)
    {       
        //
    }

    public function edit(RoiAccountabilityReport $roi_accountability_report)
    {
        $years = range(2023, 2028);
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $doctors = Doctor::pluck('doctor_name', 'id');       
        $employees = Employee::pluck('name', 'id');
        $products = Product::pluck('name', 'id');

        $authUser = auth()->user()->roles->pluck('name')->first();
        $conditions = [];
        $conditions[] = ['approval_level_2', true];
        if($authUser == 'Marketing Executive'){            
            $conditions[] = ['employee_id', auth()->user()->id];          
        }   
        $gaf_code = GrantApproval::where($conditions)->pluck('code', 'id');
        return view('roi_accountability_reports.edit', ['roi_accountability_report' => $roi_accountability_report, 'employees'=>$employees, 'doctors'=>$doctors, 'gaf_code'=>$gaf_code, 'products'=>$products,'years'=>$years, 'months'=>$months]); 
    }

    public function update(RoiAccountabilityReport $roi_accountability_report, RoiAccountabilityReportRequest $request) 
    {
        $roi_accountability_report->update($request->all());
        $data = $request->collect('product_details');
        
        foreach($data as $record){
            RoiAccountabilityReportDetail::upsert([
                'id' => $record['id'] ?? null,
                'roi_accountability_report_id' => $roi_accountability_report->id,
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'month' => $record['month'],
                'act_vol' => $record['act_vol'],
                'act_val' => $record['act_val'],
                'scheme' => $record['scheme'],
            ],[
                'id'
            ]);
        }
        $request->session()->flash('success', 'Roi Accountability Report updated successfully!');
        return redirect()->route('roi_accountability_reports.index');
    }
  
    public function destroy(Request $request, RoiAccountabilityReport $roi_accountability_report)
    {
        $roi_accountability_report->delete();
        $request->session()->flash('success', 'Roi Accountability Report deleted successfully!');
        return redirect()->route('roi_accountability_reports.index');
    }

    public function report()
    {
        $doctors = Doctor::select('id', 'doctor_name')->OrderBy('doctor_name', 'ASC')->get();
        $zonalManagers = Employee::select('e1.*')->from('employees as e1')->join('employees as e2','e1.id', '=', 'e2.reporting_office_1')->distinct()->get();
        return view('roi_accountability_reports.report', compact('zonalManagers','doctors'));        
    }

    public function reportRAR(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $zonalManager = $request->zonalManager;
        $doctor = $request->doctor;
        return Excel::download(new RARExport($from_date, $to_date, $zonalManager,$doctor), 'RAR_report.xlsx');
    }


    public function search(Request $request){
         


        $authUser = auth()->user()->roles->pluck('name')->first();
        
        $data = $request->input('search');

        if($authUser == 'Marketing Executive'){        
            $roi_accountability_reports = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])
            // $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
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
           ->whereRelation('GrantApproval', 'employee_id', auth()->user()->id)
          ->paginate(12);

        } elseif($authUser == 'Area Manager'){               
            $roi_accountability_reports = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])
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
           ->whereHas('GrantApproval.Manager', function($query) use ($data){
                 $query->where('reporting_office_2', auth()->user()->id);
           })
          ->paginate(12);

        
        } elseif($authUser == 'Zonal Manager'){
        
            $roi_accountability_reports = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])
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
            ->whereHas('GrantApproval.Manager', function($query) use ($data){
            $query->where('reporting_office_1', auth()->user()->id);
            })
          ->paginate(12);

        }
        else{       
            $roi_accountability_reports = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])
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
          ->paginate(12);

        }

      return view('roi_accountability_reports.index', ['roi_accountability_reports'=>$roi_accountability_reports]);

    }


    public function searchStatus(Request $request){

        $authUser = auth()->user()->roles->pluck('name')->first();
        
        $data = $request->input('search');

        if($authUser == 'Marketing Executive'){        
            $roi_accountability_reports = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])
            // $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']])
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
           ->whereRelation('GrantApproval', 'employee_id', auth()->user()->id)
          ->paginate(12);

        } elseif($authUser == 'Area Manager'){               
            $roi_accountability_reports = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])
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
           ->whereHas('GrantApproval.Manager', function($query) use ($data){
                 $query->where('reporting_office_2', auth()->user()->id);
           })
          ->paginate(12);

        
        } elseif($authUser == 'Zonal Manager'){
        
            $roi_accountability_reports = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])
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
            ->whereHas('GrantApproval.Manager', function($query) use ($data){
            $query->where('reporting_office_1', auth()->user()->id);
            })
          ->paginate(12);

        }
        else{       
            $roi_accountability_reports = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])
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
          ->paginate(12);

        }

      return view('roi_accountability_reports.index', ['roi_accountability_reports'=>$roi_accountability_reports]);

    }


}
