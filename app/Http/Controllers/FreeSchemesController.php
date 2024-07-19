<?php

namespace App\Http\Controllers;
use Excel;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Chemist;
use App\Models\Product;
use App\Models\Activity;
use App\Models\Employee;
use App\Models\Stockist;
use App\Exports\FSExport;
use App\Models\FreeScheme;
use Illuminate\Http\Request;
use App\Models\FreeSchemeDetail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FreeSchemeRequest;

class FreeSchemesController extends Controller
{
    public function index()
    {
        $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])->orderBy('id', 'DESC')->paginate(12);
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $manager = auth()->user()->id;
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            ->where('employee_id', $manager)
            ->orderBy('id', 'DESC')->paginate(12);
          
        } elseif($authUser == 'Area Manager'){
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            ->orderBy('id', 'DESC')->paginate(12);
           
        } elseif($authUser == 'Zonal Manager'){
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->orderBy('id', 'DESC')->paginate(12);          
        }       
        // dd($free_schemes->Stockist); 
        return view('free_schemes.index', ['free_schemes' => $free_schemes]);
    }

    public function create()
    {
        $authUser = auth()->user()->roles->pluck('name')->first();       
        $doctors = Doctor::pluck('doctor_name', 'id');
        $stockists = Stockist::pluck('stockist', 'id');
        $chemists = Chemist::pluck('chemist', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
            $stockists = Stockist::where('employee_id_3', auth()->user()->id)->pluck('stockist', 'id');
            $chemists = Chemist::where('employee_id', auth()->user()->id)->pluck('chemist', 'id');
            
        }
        return view('free_schemes.create')->with(['employees'=>$employees, 'stockists'=>$stockists,'chemists'=>$chemists, 'doctors'=>$doctors, 'products'=>$products]);
    }

    public function store(FreeScheme $free_scheme, FreeSchemeRequest $request) 
    {
        $input = $request->all();   
        $free_scheme = FreeScheme::create($input); 
        $data = $request->collect('free_scheme_details');        
        foreach($data as $record){
            FreeSchemeDetail::create([
                'free_scheme_id' => $free_scheme->id,
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'qty' => $record['qty'],
                'free' => $record['free'],
                'val' => $record['val'],
            ]);            
        }   
        $request->session()->flash('success', 'Free Schemes saved successfully!');
        return redirect()->route('free_schemes.index'); 
    }

    public function report()
    {
        $activities = Activity::all();
        $doctors = Doctor::paginate(310);
        return view('free_schemes.report',compact('activities','doctors'));
    }

    public function reportFS(Request $request)
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
        // $activity = $request->activity;
        // $doctor = $request->doctor;
        return Excel::download(new FSExport($from_date, $to_date), 'FreeScheme_report.xlsx');
    }

  
    public function show(FreeScheme $free_scheme)
    {
        //
    }

    public function edit(FreeScheme $free_scheme)
    {   
        $doctors = Doctor::pluck('doctor_name', 'id');
        $stockists = Stockist::pluck('stockist', 'id');
        $chemists = Chemist::pluck('chemist', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        $free_scheme->load(['FreeSchemeDetail']);
        $authUser = auth()->user()->roles->pluck('name')->first();   
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
            $stockists = Stockist::where('employee_id_3', auth()->user()->id)->pluck('stockist', 'id');
            $chemists = Chemist::where('employee_id', auth()->user()->id)->pluck('chemist', 'id');
        }
        return view('free_schemes.edit', ['free_scheme' => $free_scheme, 'employees'=>$employees, 'doctors'=>$doctors, 'stockists'=>$stockists, 'chemists'=>$chemists, 'products'=>$products]);
    }

    public function update(FreeScheme $free_scheme, FreeSchemeRequest $request) 
    {
        $free_scheme->update($request->all());
        $data = $request->collect('free_scheme_details');         
        foreach($data as $record){
            FreeSchemeDetail::updateOrCreate([
                'free_scheme_id' => $free_scheme->id,
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'qty' => $record['qty'],
                'free' => $record['free'],
                'val' => $record['val'],
            ],[
                'id'
            ]);
        }
        $request->session()->flash('success', 'Free Scheme updated successfully!');
        return redirect()->route('free_schemes.index');
    }
  
    public function destroy(Request $request, FreeScheme $free_scheme)
    {
        $free_scheme->delete();
        $request->session()->flash('success', 'Free Scheme deleted successfully!');
        return redirect()->route('free_schemes.index');
    }
}
