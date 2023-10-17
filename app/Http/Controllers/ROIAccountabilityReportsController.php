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
        $roi_accountability_reports = RoiAccountabilityReport::orderBy('id', 'desc')->get();
        return view('roi_accountability_reports.index', compact('roi_accountability_reports'));
    }

    public function create()
    {
        $products = Product::pluck('name', 'id');
        $authUser = auth()->user()->roles->pluck('name')->first();
        $conditions = [];
        $conditions[] = ['approval_level_2', true];
        if($authUser == 'Managing Executive'){            
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
                'exp_vol' => $record['exp_vol'],
                'exp_val' => $record['exp_val'],
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
        if($authUser == 'Managing Executive'){            
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
                'exp_vol' => $record['exp_vol'],
                'exp_val' => $record['exp_val'],
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
        return view('roi_accountability_reports.report');        
    }

    public function reportRAR(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ],[
            'from_date.required' => 'You have to choose From-Date',
            'to_date.required' => 'You have to choose To-Date'
        ]);
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        return Excel::download(new RARExport($from_date, $to_date), 'RAR_report.xlsx');
    }
}
