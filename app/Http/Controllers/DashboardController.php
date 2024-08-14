<?php

namespace App\Http\Controllers;

use App\Models\FreeScheme;
use Illuminate\Http\Request;
use App\Models\GrantApproval;
use App\Mail\TestNotification;
use App\Models\CustomerTracking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\RoiAccountabilityReport;
use App\Models\DoctorBusinessMonitoring;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])->orderBy('id', 'DESC')->paginate(12);
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $manager = auth()->user()->id;
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            ->where('employee_id', $manager)
            ->where('status', 'Open')
            ->orderBy('id', 'DESC')->paginate(12);

        } elseif($authUser == 'Area Manager'){
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            ->where('approval_level_1', false)
            ->where('status', 'Open')
            ->orderBy('id', 'DESC')->paginate(12);

        } elseif($authUser == 'Zonal Manager'){
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->where('approval_level_2', false)
            ->where('approval_level_1', true)
            ->orderBy('id', 'DESC')->paginate(12);
        }
        elseif($authUser == 'Root'){
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            ->where('approval_level_2', true)
            ->where('approval_level_3', false)
            ->orderBy('id', 'DESC')->paginate(12);
        }

        // grant approvals

        $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->orderBy('code', 'DESC')->paginate(12);
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $manager = auth()->user()->id;
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            ->where('employee_id', $manager)
            ->where('status', 'Open')
            ->orderBy('code', 'DESC')->paginate(12);

        } elseif($authUser == 'Area Manager'){
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
                ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
                ->where('approval_level_1', false)
                ->where('status', 'Open')
                ->orderBy('code', 'DESC')->paginate(12);


        } elseif($authUser == 'Zonal Manager'){
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->where('approval_level_2', false)
            ->where('approval_level_1', true)
            ->orderBy('code', 'DESC')->paginate(12);
        }
        elseif($authUser == 'Root'){
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            ->where('approval_level_2', false)
            ->orderBy('code', 'DESC')->paginate(12);
        }


        // Doctor Business Monitoring
        $query = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']]);
        $authUser = auth()->user()->roles->pluck('name')->first();

        $conditions = [];
        if($authUser == 'Marketing Executive'){
            $conditions[] = ['employee_id', auth()->user()->id];
            $conditions[] = ['status', 'Open'];

        } elseif($authUser == 'Area Manager'){
            // $conditions[] = ['employee_id', auth()->user()->id];
            $query->whereHas('GrantApproval', function($query){
                  $query->whereHas('Manager', function($query){
                    $query->whereHas('AreaManager', function($query){
                         $query->where('id', '=', auth()->user()->id);
                    });
                 });
             })->where('approval_level_1', false)
             ->where('status', 'Open');



        } elseif($authUser == 'Zonal Manager'){
            // $conditions[] = ['employee_id', auth()->user()->id];
             $query->whereHas('GrantApproval', function($query){
                  $query->whereHas('Manager', function($query){
                    $query->whereHas('ZonalManager', function($query){
                         $query->where('id', '=', auth()->user()->id);
                    });
                 });
             })->where('approval_level_2', false)
             ->where('approval_level_1', true);
        }
        elseif($authUser == 'Root'){
            // $conditions[] = ['employee_id', auth()->user()->id];
             $query->where('approval_level_2', false);
        }

        $doctor_business_monitorings = $query->whereRelation('GrantApproval', $conditions)->orderBy('id', 'DESC')->paginate(12);
        // $doctor_business_monitorings = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])->whereRelation('GrantApproval', $conditions)->orderBy('id', 'DESC')->paginate(12);


        //  roi accountability
        // $roi_accountability_reports = RoiAccountabilityReport::orderBy('id', 'desc')->get();
        // return view('roi_accountability_reports.index', compact('roi_accountability_reports'));
        $query = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]]);
        $authUser = auth()->user()->roles->pluck('name')->first();
        $conditions = [];
        if($authUser == 'Marketing Executive'){
            $conditions[] = ['employee_id', auth()->user()->id];

        } elseif($authUser == 'Area Manager'){
            $query->whereHas('GrantApproval', function($query){
                $query->whereHas('Manager', function($query){
                  $query->whereHas('AreaManager', function($query){
                       $query->where('id', '=', auth()->user()->id);
                  });
               });
           });

        } elseif($authUser == 'Zonal Manager'){
            $query->whereHas('GrantApproval', function($query){
                $query->whereHas('Manager', function($query){
                  $query->whereHas('ZonalManager', function($query){
                       $query->where('id', '=', auth()->user()->id);
                  });
               });
           });
        }
        $roi_accountability_reports = $query->whereRelation('GrantApproval', $conditions)->orderBy('id', 'DESC')->paginate(12);

        // $roi_accountability_reports = RoiAccountabilityReport::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager']]])->whereRelation('GrantApproval', $conditions)->orderBy('id', 'DESC')->paginate(12);

        // Customer Tracking

        $customer_trackings = CustomerTracking::with(['Manager'=>['ZonalManager', 'AreaManager']])->orderBy('id', 'DESC')->paginate(12);

        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $manager = auth()->user()->id;
            $customer_trackings = CustomerTracking::with(['Manager'=>['ZonalManager', 'AreaManager']])
            ->where('employee_id', $manager)
            ->orderBy('id', 'DESC')->paginate(12);

        } elseif($authUser == 'Area Manager'){
            $customer_trackings = CustomerTracking::with(['Manager'=>['ZonalManager', 'AreaManager']])
            ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            ->orderBy('id', 'DESC')->paginate(12);

        } elseif($authUser == 'Zonal Manager'){
            $customer_trackings = CustomerTracking::with(['Manager'=>['ZonalManager', 'AreaManager']])
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->orderBy('id', 'DESC')->paginate(12);
        }

        return view('dashboard', ['free_schemes' => $free_schemes, 'grant_approvals'=> $grant_approvals, 'doctor_business_monitorings' => $doctor_business_monitorings, 'roi_accountability_reports' => $roi_accountability_reports, 'customer_trackings' => $customer_trackings]);
    }

    public function test()
    {
        Mail::to("ghadiganesh2002@gmail.com")
            ->send(new TestNotification());
            Log::info('test');
        exit;
    }

}