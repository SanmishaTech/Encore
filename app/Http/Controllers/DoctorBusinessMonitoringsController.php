<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
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
        $gaf_code = GrantApproval::pluck('code', 'id');
        return view('doctor_business_monitorings.create')->with(['gaf_code' => $gaf_code]);
    }

    public function store(DoctorBusinessMonitoring $doctor_business_monitoring, DoctorBusinessMonitoringRequest $request) 
    {
        $input = $request->all(); 
        $doctor_business_monitoring = DoctorBusinessMonitoring::create($input); 
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
        return view('doctor_business_monitorings.edit', ['doctor_business_monitoring' => $doctor_business_monitoring, 'employees'=>$employees, 'doctors'=>$doctors, 'gaf_code'=>$gaf_code]);        
    }

    public function update(DoctorBusinessMonitoring $doctor_business_monitoring, DoctorBusinessMonitoringRequest $request) 
    {
        $DoctorBusinessMonitoring->update($request->all());
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
