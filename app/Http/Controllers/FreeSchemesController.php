<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\FreeSchemeDetail;
use App\Models\Doctor;
use App\Models\Stockist;
use App\Models\Chemist;
use App\Models\FreeScheme;
use App\Models\Product;
use Illuminate\Http\Request;
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
