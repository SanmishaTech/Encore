<?php

namespace App\Exports;
use DB;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\GrantApproval;
use App\Models\DoctorBusinessMonitoring;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CDBMExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $condition = [];
        if(isset($request->from_date)){
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date);
            $condition[] = ['date', '>=' , $fromDate];
        }        

        if(isset($request->to_date)){
            $toDate = Carbon::createFromFormat('Y-m-d', $request->to_date);
            $condition[] = ['date', '<=' , $toDate];
        }
        
        $doctor_business_monitorings = ProductDetail::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']],'Doctor']])->whereRelation('DoctorBusinessMonitoring', $condition)->get();

        return $doctor_business_monitorings;
    }
    public function headings(): array
    {
        return ["ME HQ","ABM HQ","RBM HQ","Doctor Name","Specialty","Location","Date","Month","Amount","Product","NRV","M Exp in Vol","M + 1 Exp in Vol","M + 2 Exp in Vol","M + 3 Exp in Vol","M + 4 Exp in Vol","M + 5 Exp in Vol","M + 6 Exp in Vol","Total M to M + 6 Exp Vol","Total M to M + 6 Exp Val","Scheme %"];
    }
    public function map($doctor_business_monitorings): array
    {
        if(!empty($doctor_business_monitorings)){
            foreach($doctor_business_monitorings as $doctor_business_monitoring){
                $doctor_business_monitoring->GrantApproval->Manager->name;
                $doctor_business_monitoring->GrantApproval->Manager->name;     
                $doctor_business_monitoring->GrantApproval->Manager->AreaManager->name;
                $doctor_business_monitoring->GrantApproval->Manager->ZonalManager->name;
                $doctor_business_monitoring->GrantApproval->Doctor->doctor_name;
                $doctor_business_monitoring->GrantApproval->Doctor->speciality;
                $doctor_business_monitoring->GrantApproval->Doctor->type;
                $doctor_business_monitoring->date;
                $doctor_business_monitoring->month;
                $doctor_business_monitoring->amount;
                $doctor_business_monitoring->Product->name;       
                $doctor_business_monitoring->Product->nrv;
                $doctor_business_monitoring->avg_business_units;
                $doctor_business_monitoring->avg_business_value;
                $doctor_business_monitoring->exp_vol;
                $doctor_business_monitoring->exp_vol_1;
                $doctor_business_monitoring->exp_vol_2;
                $doctor_business_monitoring->exp_vol_3;
                $doctor_business_monitoring->exp_vol_4;
                $doctor_business_monitoring->exp_vol_5;
                $doctor_business_monitoring->exp_vol_6;
                $doctor_business_monitoring->total_exp_vol;
                $doctor_business_monitoring->total_exp_val;
                $doctor_business_monitoring->scheme;
            }
        }  
      
    }

}
