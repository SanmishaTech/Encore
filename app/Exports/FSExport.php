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
    public function __construct($from_date,$to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
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
        
       
        return view('free_schemes.print', [
            // dd($condition),
            // 'print' => FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor'])->where($condition)->get()
            // 'print' => ProductDetail::with(['Product', 'FreeScheme'=>['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'],'Doctor']]])->whereRelation('FreeScheme', $condition)->get()
          'print' => FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get()
            //   'print' => FreeSchemeDetail::with(['Product'])->whereRelation('FreeScheme', $condition)->get()
        ]);
    }
}
