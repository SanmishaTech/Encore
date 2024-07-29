<?php

namespace App\Http\Controllers;
use Excel;
use Exception;
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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FreeSchemeRequest;
use App\Mail\FreeSchemeApprovalNotification;

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
        if($request->hasFile('proof_of_order')){
            $poffileNameWithExt = $request->file('proof_of_order')->getClientOriginalName();
            $poffilename = pathinfo($poffileNameWithExt, PATHINFO_FILENAME);
            $pofExtention = $request->file('proof_of_order')->getClientOriginalExtension();
            $pofFileNameToStore = $poffilename.'_'.time().'.'.$pofExtention;
            $pofPath = $request->file('proof_of_order')->storeAs('public/FreeScheme/proof_of_order', $pofFileNameToStore);
            $input['proof_of_order'] = $pofFileNameToStore;
        }
       
        if($request->hasFile('proof_of_delivery')){
            $podfileNameWithExt = $request->file('proof_of_delivery')->getClientOriginalName();
            $podfilename = pathinfo($podfileNameWithExt, PATHINFO_FILENAME);
            $podExtention = $request->file('proof_of_delivery')->getClientOriginalExtension();
            $podFileNameToStore = $podfilename.'_'.time().'.'.$podExtention;
            $podPath = $request->file('proof_of_delivery')->storeAs('public/FreeScheme/proof_of_delivery', $podFileNameToStore);
            $input['proof_of_delivery'] = $podFileNameToStore;
        }

        $input['status'] = 'Open';  
        $free_scheme = FreeScheme::create($input); 
        $data = $request->collect('free_scheme_details');        
        foreach($data as $record){
            FreeSchemeDetail::create([
                'free_scheme_id' => $free_scheme->id,
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'qty' => $record['qty'],
                'free_qty' => $record['fqty'],
                'free' => $record['free'],
                'val' => $record['val'],
            ]);            
        }   
        $request->session()->flash('success', 'Free Schemes saved successfully!');
        return redirect()->route('free_schemes.index'); 
    }

    public function report()
    {
        $doctors = Doctor::select('id', 'doctor_name')->OrderBy('doctor_name', 'ASC')->get();
        $zonalManagers = Employee::select('e1.*')->from('employees as e1')->join('employees as e2','e1.id', '=', 'e2.reporting_office_1')->distinct()->get();
        return view('free_schemes.report',compact('doctors','zonalManagers'));
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
        $doctor = $request->doctor;
        $zonalManager = $request->zonalManager;
        return Excel::download(new FSExport($from_date, $to_date,$doctor,$zonalManager), 'FreeScheme_report.xlsx');
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
        $input = $request->all(); 
        if($request->hasFile('proof_of_order')){
            if ($free_scheme->proof_of_order) {
                Storage::delete('public/FreeScheme/proof_of_order/' . $free_scheme->proof_of_order);
            }
            $poffileNameWithExt = $request->file('proof_of_order')->getClientOriginalName();
            $poffilename = pathinfo($poffileNameWithExt, PATHINFO_FILENAME);
            $pofExtention = $request->file('proof_of_order')->getClientOriginalExtension();
            $pofFileNameToStore = $poffilename.'_'.time().'.'.$pofExtention;
            $pofPath = $request->file('proof_of_order')->storeAs('public/FreeScheme/proof_of_order', $pofFileNameToStore);
            $input['proof_of_order'] = $pofFileNameToStore;
        }
       
        if($request->hasFile('proof_of_delivery')){

            if ($free_scheme->proof_of_order) {
                Storage::delete('public/FreeScheme/proof_of_delivery/' . $free_scheme->proof_of_order);
            }
            $podfileNameWithExt = $request->file('proof_of_delivery')->getClientOriginalName();
            $podfilename = pathinfo($podfileNameWithExt, PATHINFO_FILENAME);
            $podExtention = $request->file('proof_of_delivery')->getClientOriginalExtension();
            $podFileNameToStore = $podfilename.'_'.time().'.'.$podExtention;
            $podPath = $request->file('proof_of_delivery')->storeAs('public/FreeScheme/proof_of_delivery', $podFileNameToStore);
            $input['proof_of_delivery'] = $podFileNameToStore;
        }


        $free_scheme->update($input);
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
        if (!empty($free_scheme->proof_of_order) && Storage::exists('public/FreeScheme/proof_of_order/'.$free_scheme->proof_of_order)) {
            Storage::delete('public/FreeScheme/proof_of_order/'.$free_scheme->proof_of_order);
           }

           if (!empty($free_scheme->proof_of_delivery) && Storage::exists('public/FreeScheme/proof_of_delivery/'.$free_scheme->proof_of_delivery)) {
            Storage::delete('public/FreeScheme/proof_of_delivery/'.$free_scheme->proof_of_delivery);
           }

        $free_scheme->delete();
        $request->session()->flash('success', 'Free Scheme deleted successfully!');
        return redirect()->route('free_schemes.index');
    }

    public function rejected(FreeScheme $free_scheme) 
    {
       
        if(auth()->user()->roles->pluck('name')->first() == 'Root'){
            $free_scheme->status = 'Level 3 Rejected';
            $free_scheme->approval_level_3 = false;
        }
        elseif(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $free_scheme->status = 'Level 2 Rejected';
            $free_scheme->approval_level_2 = false;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $free_scheme->status = 'Level 1 Rejected';
            $free_scheme->approval_level_1 = false;
        } else{
            if($free_scheme->approval_level_1 == false){
                $free_scheme->status = 'Level 2 Rejected';
                $free_scheme->approval_level_2 = false;
            } else {
                $free_scheme->status = 'Level 1 Rejected';
                $free_scheme->approval_level_1 = false;

            }
        }     
        $free_scheme->update();
        // $input = [];
        // $input['status'] =  $free_scheme->status;
        // $input['free_scheme_id'] = $free_scheme->id;
        // FreeSchemeDetail::create($input);
        return redirect()->route('free_schemes.index');
    }


    public function approval(FreeScheme $free_scheme, Request $request) 
    {
       // $free_scheme = GrantApproval::find($request->id);
        $input = [];
        if(auth()->user()->roles->pluck('name')->first() == 'Root'){
            $free_scheme->status = 'Level 3 Approved';
            $free_scheme->approval_level_3 = true;
            $free_scheme->approval_level_2 = true;
            $free_scheme->approval_level_1 = true;
        }
        elseif(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $free_scheme->status = 'Level 2 Approved';
            $free_scheme->approval_level_2 = true;
            $free_scheme->approval_level_1 = true;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $free_scheme->status = 'Level 1 Approved';
            $free_scheme->approval_level_1 = true;
        } else{
            if($free_scheme->approval_level_1 == true){
                $free_scheme->status = 'Level 2 Approved';
                $free_scheme->approval_level_2 = true;

            } else {
                $free_scheme->status = 'Level 1 Approved';
                $free_scheme->approval_level_1 = true;
            }
        }     

        $free_scheme->approved_on = Carbon::now();
        $free_scheme->update();

        if(auth()->user()->roles->pluck('name')->first() == 'Root'){
            $condition[] = ['id', '=', $free_scheme->id];
            $print = FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get();
            // $recipients =  $print[0]->FreeScheme->Stockist->cfa_email;
            // $recipients = "ganeshghadi084@gmail.com";
            // if (!empty($recipients)){
            
                Mail::to('ganeshghadi084@gmail.com')->send(new FreeSchemeApprovalNotification($print));
           
            // }
        }
       
        return redirect()->route('free_schemes.index');
    }

     public function approval_form(FreeScheme $free_scheme)
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
        return view('free_schemes.approval_form', ['free_scheme' => $free_scheme, 'employees'=>$employees, 'doctors'=>$doctors, 'stockists'=>$stockists, 'chemists'=>$chemists, 'products'=>$products]);
    }


}
