<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\FreeSchemeDetail;
use App\Models\Doctor;
use App\Models\Stockist;
use App\Models\Chemist;
use App\Models\FreeScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FreeSchemeRequest;

class FreeSchemesController extends Controller
{
    public function index()
    {
        $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->orderBy('code', 'DESC')->get();
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $manager = auth()->user()->id;
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            ->where('employee_id', $manager)
            ->orderBy('code', 'DESC')->get();
          
        } elseif($authUser == 'Area Manager'){
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            ->orderBy('code', 'DESC')->get();
           
        } elseif($authUser == 'Zonal Manager'){
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->where('approval_level_1', true)
            ->orderBy('code', 'DESC')->get();           
        }        
        return view('grant_approvals.index', ['grant_approvals' => $grant_approvals]);
    }

    public function create()
    {
        //
    }

    public function store(FreeScheme $free_scheme, FreeSchemeRequest $request) 
    {
       //
    }
  
    public function show(FreeScheme $free_scheme)
    {
        //
    }

    public function edit(FreeScheme $free_scheme)
    {
        //
    }

    public function update(FreeScheme $free_scheme, FreeSchemeRequest $request) 
    {
       //
    }
  
    public function destroy(Request $request, FreeScheme $free_scheme)
    {
        $free_scheme->delete();
        $request->session()->flash('success', 'Free Scheme deleted successfully!');
        return redirect()->route('free_schemes.index');
    }

}
