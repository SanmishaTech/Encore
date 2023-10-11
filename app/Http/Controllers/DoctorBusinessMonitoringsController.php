<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\GrantApproval;
use App\Models\DoctorBusinessMonitoring;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorBusinessMonitoringRequest;

class DoctorBusinessMonitoringsController extends Controller
{
    public function index()
    {
        $doctor_business_monitorings = DoctorBusinessMonitoring::all();
        return view('doctor_business_monitorings.index', ['doctor_business_monitorings' => $doctor_business_monitorings]);
    }

    public function create()
    {
        $products = Product::pluck('name', 'id');
        $gaf_code = GrantApproval::pluck('code', 'id');
        return view('doctor_business_monitorings.create')->with(['gaf_code' => $gaf_code, 'products' => $products]);
    }

    public function store(DoctorBusinessMonitoring $doctor_business_monitoring, DoctorBusinessMonitoringRequest $request) 
    {
        $input = $request->all(); 
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
        $gaf_code = GrantApproval::pluck('code', 'id');
        $employees = Employee::pluck('name', 'id');
        $products = Product::pluck('name', 'id');
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
  
    public function destroy(Request $request, DoctorBusinessMonitoring $doctor_business_monitoring)
    {
        $doctor_business_monitoring->delete();
        $request->session()->flash('success', 'Doctor Business Monitoring deleted successfully!');
        return redirect()->route('doctor_business_monitorings.index');
    }
}
