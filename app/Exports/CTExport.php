<?php

namespace App\Exports;


use DB;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\Employee;
use App\Models\FreeScheme;
use Illuminate\Http\Request;
use App\Models\GrantApproval;
use App\Models\ProductDetail;
use App\Models\CustomerTracking;
use Illuminate\Contracts\View\View;
use App\Models\CustomerTrackingDetail;
use App\Models\DoctorBusinessMonitoring;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CTExport implements FromView
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
            $condition[] = ['proposal_date', '>=' , $fromDate];
            // dd($fromDate);
        }        
        
        if(isset($this->to_date)){
            $toDate = Carbon::createFromFormat('Y-m-d', $this->to_date);
            $condition[] = ['proposal_date', '<=' , $toDate];
        }
        
        $query = CustomerTrackingDetail::with(['CustomerTracking' => ['Manager' => ['AreaManager', 'ZonalManager']], 'Doctor']);

          if(isset($this->zonalManager)){
            $query->whereHas('CustomerTracking', function($query){
                 $query->whereHas('Manager', function($query){
                    $query->whereHas('ZonalManager', function($query){
                        $query->where('id', '=', $this->zonalManager);
                    });
                 });
            });
          }

          $printData = $query->whereRelation('CustomerTracking', $condition)->get();
        return view('customer_trackings.print', [
            // dd($condition),
            // 'print' => RoiAccountabilityReportDetail::with(['RoiAccountabilityReport'])->whereRelation('RoiAccountabilityReport', $condition)->get()
            'print' => $printData
        ]);
    }
}

