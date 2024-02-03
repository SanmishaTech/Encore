<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\CustomerTrackingDetail;
use App\Models\CustomerTracking;
use App\Models\Product;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerTrackingRequest;
use Illuminate\Http\Request;

class CustomerTrackingsController extends Controller
{
    public function index()
    {
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $manager = auth()->user()->id;
            $customer_trackings = CustomerTracking::with(['Manager'=>['ZonalManager', 'AreaManager']])
            ->where('employee_id', $manager)
            ->orderBy('id', 'DESC')->get();
          
        } elseif($authUser == 'Area Manager'){
            $customer_trackings = CustomerTracking::with(['Manager'=>['ZonalManager', 'AreaManager']])
            ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            ->orderBy('id', 'DESC')->get();
           
        } elseif($authUser == 'Zonal Manager'){
            $customer_trackings = CustomerTracking::with(['Manager'=>['ZonalManager', 'AreaManager']])
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->where('approval_level_1', true)
            ->orderBy('id', 'DESC')->get();           
        }       
        // dd($customer_trackings->Stockist); 
        return view('customer_trackings.index', ['customer_trackings' => $customer_trackings]);
    }

    public function create()
    {
        $authUser = auth()->user()->roles->pluck('name')->first();       
        $doctors = Doctor::pluck('doctor_name', 'id');        
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
        }
        return view('customer_trackings.create')->with(['employees'=>$employees, 'doctors'=>$doctors, 'products'=>$products]);
    }

    public function store(CustomerTracking $customer_tracking, CustomerTrackingRequest $request) 
    {
        $input = $request->all();   
        $customer_tracking = CustomerTracking::create($input); 
        $data = $request->collect('product_details');        
        foreach($data as $record){
            CustomerTrackingDetail::create([
                'customer_tracking_id' => $customer_tracking->id,
                'doctor_id' => $record['doctor_id'],
                'speciality' => $record['speciality'],
                'location' => $record['location'],
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'qty' => $record['qty'],
                'val' => $record['val'],
            ]);            
        }   
        $request->session()->flash('success', 'Customer Tracking saved successfully!');
        return redirect()->route('customer_trackings.index'); 
    }
  
    public function show(CustomerTracking $customer_tracking)
    {
        //
    }

    public function edit(CustomerTracking $customer_tracking)
    {   
        $doctors = Doctor::pluck('doctor_name', 'id');        
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        $customer_tracking->load(['CustomerTrackingDetail']);
        $authUser = auth()->user()->roles->pluck('name')->first();   
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
        }
        return view('customer_trackings.edit', ['customer_tracking' => $customer_tracking, 'employees'=>$employees, 'doctors'=>$doctors, 'products'=>$products]);
    }

    public function update(CustomerTracking $customer_tracking, CustomerTrackingRequest $request) 
    {
        $customer_tracking->update($request->all());
        $data = $request->collect('product_details');         
        foreach($data as $record){
            CustomerTrackingDetail::create([
                'customer_tracking_id' => $customer_tracking->id,
                'doctor_id' => $record['doctor_id'],
                'speciality' => $record['speciality'],
                'location' => $record['location'],
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'qty' => $record['qty'],
                'val' => $record['val'],
            ],[
                'id'
            ]);
        }
        $request->session()->flash('success', 'Customer Tracking updated successfully!');
        return redirect()->route('customer_trackings.index');
    }
  
    public function destroy(Request $request, CustomerTracking $customer_tracking)
    {
        $customer_tracking->delete();
        $request->session()->flash('success', 'Customer Tracking deleted successfully!');
        return redirect()->route('customer_trackings.index');
    }
}
