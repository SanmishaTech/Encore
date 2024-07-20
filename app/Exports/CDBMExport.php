<?php

namespace App\Exports;
use DB;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\GrantApproval;
use App\Models\DoctorBusinessMonitoring;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Http\Request;

class CDBMExport implements FromView
{
    use Exportable;
    public function __construct($from_date, $to_date, $doctor)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->doctor = $doctor;
    }

    public function view(): View
    {
        $condition = [];
        if(isset($this->from_date)){
            $fromDate = Carbon::createFromFormat('Y-m-d', $this->from_date);
            $condition[] = ['date', '>=' , $fromDate];
        }        

        if(isset($this->to_date)){
            $toDate = Carbon::createFromFormat('Y-m-d', $this->to_date);
            $condition[] = ['date', '<=' , $toDate];
        }

        if(isset($this->doctor)){
            $condition[] = ['doctor_id', '=' , $this->doctor];
        }

        return view('doctor_business_monitorings.print', [
            'print' => ProductDetail::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'],'Doctor']]])->whereRelation('DoctorBusinessMonitoring', $condition)->get()
        ]);
    } 
}
