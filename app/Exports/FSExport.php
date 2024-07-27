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
use App\Models\FreeSchemeDetail;
use Illuminate\Contracts\View\View;
use App\Models\DoctorBusinessMonitoring;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FSExport implements FromView
{
    use Exportable;
    public function __construct($from_date,$to_date,$doctor,$zonalManager)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->doctor = $doctor;
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

        if(isset($this->doctor)){
            $condition[] = ['doctor_id', '=' , $this->doctor];
        }
        
        $condition[] = ['approval_level_2', '=', true];

        $query = FreeSchemeDetail::with([
            'Product', 
            'FreeScheme' => [
                'Manager' => ['AreaManager', 'ZonalManager'], 
                'Stockist', 
                'Chemist', 
                'Doctor'
            ]
        ]);
    
        // Apply conditions on FreeScheme relationship
        if (isset($this->zonalManager)) {
            $query->whereHas('FreeScheme', function ($query) {
                $query->whereHas('Manager', function ($query) {
                    $query->whereHas('ZonalManager', function ($query) {
                        $query->where('id', '=', $this->zonalManager);
                    });
                });
            });
        }
    
        // Apply additional conditions
        $printData = $query->whereRelation('FreeScheme', $condition)->get();
       
        return view('free_schemes.print', [
        // 'print' => FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get()
          'print' => $printData,   
      ]);
    }
}
