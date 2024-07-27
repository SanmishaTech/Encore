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
        $products = Product::pluck('name', 'id');
        $authUser = auth()->user()->roles->pluck('name')->first();
        $conditions = [];
        $conditions[] = ['approval_level_2', true];
        if($authUser == 'Marketing Executive'){            
            $conditions[] = ['employee_id', auth()->user()->id];
          
        }   
        $gaf_code = GrantApproval::where($conditions)->pluck('code', 'id');
        return view('roi_accountability_reports.create')->with(['gaf_code' => $gaf_code, 'products' => $products]);
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
        return view('roi_accountability_reports.edit', ['roi_accountability_report' => $roi_accountability_report, 'employees'=>$employees, 'doctors'=>$doctors, 'gaf_code'=>$gaf_code, 'products'=>$products]); 
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
}
