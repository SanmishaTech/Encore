<?php

namespace App\Exports;
use DB;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\RoiAccountabilityReportDetail;
use App\Models\GrantApproval;
use App\Models\RoiAccountabilityReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Http\Request;

class RARExport implements FromView
{
    use Exportable;
    public function __construct($from_date,$to_date,$zonalManager)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->zonalManager = $zonalManager;
    }

    public function view(): View
    {
        $condition = [];
        if(isset($this->from_date)){
            $fromDate = Carbon::createFromFormat('Y-m-d', $this->from_date);
            $condition[] = ['rar_date', '>=' , $fromDate];
            // dd($fromDate);
        }        
        
        if(isset($this->to_date)){
            $toDate = Carbon::createFromFormat('Y-m-d', $this->to_date);
            $condition[] = ['rar_date', '<=' , $toDate];
        }
  
        $query = RoiAccountabilityReportDetail::with(['Product', 'RoiAccountabilityReport'=>['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'],'Doctor']]]);

       if(isset($this->zonalManager)){
          $query->whereHas('RoiAccountabilityReport', function($query){
             $query->whereHas('GrantApproval', function($query){
                   $query->whereHas('Manager', function($query){
                          $query->whereHas('ZonalManager', function($query){
                            $query->where('id', '=', $this->zonalManager);
                          });
                   });
             });
          });
       }

       $printData = $query->whereRelation('RoiAccountabilityReport', $condition)->get();
        
        return view('roi_accountability_reports.print', [
                'print'=>$printData
            // 'print' => RoiAccountabilityReportDetail::with(['Product', 'RoiAccountabilityReport'=>['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'],'Doctor']]])->whereRelation('RoiAccountabilityReport', $condition)->get()
        ]);
    }
}
