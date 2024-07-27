<?php

namespace App\Exports;
use DB;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Activity;
use App\Models\GrantApproval;
use App\Models\GrantApprovalDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Http\Request;

class GAFExport implements FromView
{
    use Exportable;
    public function __construct($from_date, $to_date, $activity, $doctor, $zonalManager)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->activity = $activity;
        $this->doctor = $doctor;
        $this->zonalManager = $zonalManager;
    }

    public function view(): View
    {
        $condition = [];
        if(isset($this->from_date)){
            $fromDate = Carbon::createFromFormat('Y-m-d', $this->from_date);
            $condition[] = ['date_of_issue', '>=' , $fromDate];
        }        

        if(isset($this->to_date)){
            $toDate = Carbon::createFromFormat('Y-m-d', $this->to_date);
            $condition[] = ['date_of_issue', '<=' , $toDate];
        }

        if(isset($this->activity)){
            $condition[] = ['activity_id', '=' , $this->activity];
        }

        if(isset($this->doctor)){
            $condition[] = ['doctor_id', '=' , $this->doctor];
        }

        // if(isset($this->zonalManager)){
        //     $condition[] = ['id', '=' , $this->zonalManager];
        // }
        
         $condition[] = ['approval_level_2', '=', true];
        
         $query = GrantApproval::with(['Manager' => ['ZonalManager', 'AreaManager'], 'Doctor', 'Activity']);

         // Apply conditions on relationships
         if (isset($this->zonalManager)) {
             $query->whereHas('Manager', function ($query) {
                 $query->whereHas('ZonalManager', function ($query) {
                     $query->where('id', '=', $this->zonalManager);
                 });
             });
         }
     
         // Apply additional conditions
         $printData = $query->where($condition)->get();
        
        return view('grant_approvals.print', [
            $doctor = Doctor::all(),
            // 'print' => GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->where($condition)->get()
            'print' => $printData,
        ]);
    } 
}
