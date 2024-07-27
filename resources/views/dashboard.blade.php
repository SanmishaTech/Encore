<x-layout.default>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @role(['Zonal Manager'])
                    {{ __("You're logged in!abc") }}
                    @endrole
                    @role(['Root'])
                    {{ __("You're logged in!") }}
                    @endrole
                </div>
            </div>
        </div>
    </div> --}}

    {{-- grant approval start --}}
    
        <br><br>
        <div x-data="form">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Grant Approvals</h5>
                </div>
                <!-- <form action="{{ route('grant_approvals.index') }}" method="GET" role="search">
                    <div class="float-right mr-2">
                        <span>
                            <button class="btn btn-info" type="submit" title="Search projects">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                    <circle cx="11.5" cy="11.5" r="9.5"
                                        stroke="currentColor" stroke-width="1.5" opacity="0.5"></circle>
                                    <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg>
                            </button>
                        </span>
                    </div>
                    <div class="float-right">
                        <input type="text" placeholder="Search" class="form-input" name="search"/>
                    </div>
                </form> -->
                <div class="mt-6">
                    <div class="table-responsive">
                        <table class="table-hover">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Marketing Executive</th>
                                    <th>Area Manager</th>
                                    <th>Zonal Manager</th>
                                    <th>Doctor</th>
                                    <th>Activity</th>
                                    <th>Proposal Amount</th>
                                    <th>Approved Amount</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grant_approvals as $grant_approval)
                                    <tr>
                                        <td>{{ @$grant_approval->code }}</td>
                                        <td>{{ @$grant_approval->Manager->name }}</td>
                                        <td>{{ @$grant_approval->Manager->AreaManager->name }}</td>
                                        <td>{{ @$grant_approval->Manager->ZonalManager->name }}</td>
                                        <td>{{ @$grant_approval->Doctor->doctor_name }}</td>
                                        <td>{{ @$grant_approval->Activity->name }}</td>
                                        <td class="whitespace-nowrap"> &#8377;  {{ @$grant_approval->proposal_amount }}</td>
                                        <td class="whitespace-nowrap"> &#8377;  {{ $grant_approval->approval_amount }}</td>
                                        <td class="whitespace-nowrap" >
                                             {{-- {!! $grant_approval->status == "Open" ? '<span class="badge bg-info"> Open </span>' : ($grant_approval->status == "Level 1 Approved" ? '<span class="badge bg-warning"> Level 1 </span>' : ($grant_approval->status == "Level 2 Approved" ? '<span class="badge bg-success"> Level 2</span>' :  ($grant_approval->status == "Level 1 Rejected" ? '<span class="badge bg-danger"> Level 1 </span>' : ($grant_approval->status == "Level 2 Rejected" ? '<span class="badge bg-danger"> Level 2</span>' : '')) ))  !!} --}}
                                             <span class="badge bg-warning"> Pending </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $grant_approvals->links() }}
                    </div>
                </div>
            </div>
        </div>
    

     {{-- grant approval end --}}


     {{-- doctor business monitoring starts --}}
     <br><br>
        <div x-data="form">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Core Doctor Business Monitoring</h5>
                </div>     
                <div class="mt-6">
                    <div class="table-responsive">       
                        <table class="table-hover">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Marketing Executive</th>
                                    <th>Area Manager</th>
                                    <th>Zonal Manager</th>
                                    <th>Doctor</th>
                                    <th>ROI</th>
                                    <th>Amount</th>
                                    <th>Approved Amount</th>
                                    <th>Total Business Value</th>
                                    <th>Total Expected Value</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctor_business_monitorings as $doctor_business_monitoring)
                                <tr>   
                                    <td>{{ @$doctor_business_monitoring->GrantApproval->code }}</td>           
                                    <td>{{ @$doctor_business_monitoring->GrantApproval->Manager->name }}</td>           
                                    <td>{{ @$doctor_business_monitoring->GrantApproval->Manager->AreaManager->name }}</td>
                                    <td>{{ @$doctor_business_monitoring->GrantApproval->Manager->ZonalManager->name }}</td>
                                    <td>{{ @$doctor_business_monitoring->GrantApproval->Doctor->doctor_name }}</td>
                                    <td>{{ round($doctor_business_monitoring->roi, 2)}} </td>
                                    <td class="whitespace-nowrap"> &#8377;  {{ $doctor_business_monitoring->GrantApproval->proposal_amount }}</td>
                                    <td class="whitespace-nowrap"> &#8377;  {{ $doctor_business_monitoring->GrantApproval->approval_amount }}</td>
                                    <td class="whitespace-nowrap"> &#8377;  {{ $doctor_business_monitoring->total_business_value }}</td>
                                    <td class="whitespace-nowrap"> &#8377;  {{ $doctor_business_monitoring->total_expected_value }}</td>
                                    <td class="whitespace-nowrap">
                                        {{-- {!! $doctor_business_monitoring->status == "Open" ? '<span class="badge bg-info"> Open </span>' : ($doctor_business_monitoring->status == "Level 1 Approved" ? '<span class="badge bg-warning"> Level 1 </span>' : ($doctor_business_monitoring->status == "Level 2 Approved" ? '<span class="badge bg-success"> Level 2</span>' :  ($doctor_business_monitoring->status == "Level 1 Rejected" ? '<span class="badge bg-danger"> Level 1 </span>' : ($doctor_business_monitoring->status == "Level 2 Rejected" ? '<span class="badge bg-danger"> Level 2</span>' : '')) ))  !!} --}}
                                        <span class="badge bg-warning"> Pending </span>

                                    </td>  
                          </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $doctor_business_monitorings->links() }}
                    </div>
                </div>
            </div>
        </div>
 
     {{-- doctor business monitoring ends --}}


     {{-- ROI Accountability report start --}}
 
        <br><br>
        <div x-data="form">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">ROI Accountability Report</h5>
                </div>
                <div class="mt-6">
                    <div class="table-responsive">
                        <table class="table-hover">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Marketing Executive</th>
                                    <th>Area Manager</th>
                                    <th>Zonal Manager</th>
                                    <th>Doctor</th>
                                    <th>Amount</th>
                                    <th>Acutal Value</th>
                                    <th>ROI</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roi_accountability_reports as $roi_accountability_report)
                                <tr>       
                                    <td>{{ @$roi_accountability_report->GrantApproval->code }}</td>         
                                    <td>{{ @$roi_accountability_report->GrantApproval->Manager->name }}</td>           
                                    <td>{{ @$roi_accountability_report->GrantApproval->Manager->AreaManager->name }}</td>
                                    <td>{{ @$roi_accountability_report->GrantApproval->Manager->ZonalManager->name }}</td>
                                    <td>{{ @$roi_accountability_report->GrantApproval->Doctor->doctor_name }}</td>
                                    <td class="whitespace-nowrap">&#8377; {{ @$roi_accountability_report->amount }}</td>
                                    <td class="whitespace-nowrap">&#8377; {{ @$roi_accountability_report->total_actual_value }}</td>
                                    <td>{{ $roi_accountability_report->roi }}</td>
                                    <td class="float-right">
                                        <ul class="flex items-center gap-2" >
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-edit-button :link=" route('roi_accountability_reports.edit', $roi_accountability_report->id)" />                               
                                            </li>
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-delete-button :link=" route('roi_accountability_reports.destroy',$roi_accountability_report->id)" />  
                                            </li>   
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $roi_accountability_reports->links() }}
                    </div>
                </div>
            </div>
        </div>
       
    {{-- ROI Accountability report end --}}



    {{-- free scheme start --}}
    <br><br>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Free Schemes</h5>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Marketing Executive</th>
                                <th>Area Manager</th>
                                <th>Zonal Manager</th>
                                <th>Doctor</th>
                                <th>Stockist</th>
                                <th>Chemist</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($free_schemes as $free_scheme)
                            <tr> 
                                <td>{{ @$free_scheme->Manager->name }}</td>           
                                <td>{{ @$free_scheme->Manager->AreaManager->name }}</td>
                                <td>{{ @$free_scheme->Manager->ZonalManager->name }}</td>
                                <td>{{ @$free_scheme->Doctor->doctor_name }}</td>
                                <td>{{ @$free_scheme->Stockist->stockist }}</td>
                                <td>{{ @$free_scheme->Chemist->chemist }}</td>  
                                <td class="whitespace-nowrap">&#8377; {{ @$free_scheme->amount }}</td> 
                                <td class="whitespace-nowrap" >
                                    {{-- {!! $free_scheme->status == "Open" ? '<span class="badge bg-warning"> Pending </span>' : ($free_scheme->status == "Level 1 Approved" ? '<span class="badge bg-warning"> Level 1 </span>' : ($free_scheme->status == "Level 2 Approved" ? '<span class="badge bg-success"> Level 2</span>' :  ($free_scheme->status == "Level 1 Rejected" ? '<span class="badge bg-danger"> Level 1 </span>' : ($free_scheme->status == "Level 2 Rejected" ? '<span class="badge bg-danger"> Level 2</span>' : '')) ))  !!} --}}
                                    <span class="badge bg-warning"> Pending </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                    {{ $free_schemes->links() }}
                </div>
            </div>
        </div>
    </div>
   
    {{-- free scheme end --}}


    {{-- Customer Tracking start --}}
    
        <br><br>
        <div x-data="form"> 
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Customer Tracking</h5>
                </div>
                <div class="mt-6">
                    <div class="table-responsive">
                        <table class="table-hover">
                            <thead>
                                <tr>
                                    <th>Marketing Executive</th>
                                    <th>Area Manager</th>
                                    <th>Zonal Manager</th>
                                    <th>Amount</th>
                                    {{-- <th style="float:right;">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer_trackings as $customer_tracking)
                                <tr> 
                                    <td>{{ @$customer_tracking->Manager->name }}</td>           
                                    <td>{{ @$customer_tracking->Manager->AreaManager->name }}</td>
                                    <td>{{ @$customer_tracking->Manager->ZonalManager->name }}</td>
                                    <td>&#8377; {{ @$customer_tracking->amount }}</td> 
                                    {{-- <td class="float-right">
                                        <ul class="flex items-center gap-2" >
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-edit-button :link=" route('customer_trackings.edit', ['customer_tracking'=> $customer_tracking->id])" />                               
                                            </li>
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-delete-button :link=" route('customer_trackings.destroy', ['customer_tracking'=> $customer_tracking->id] )" />  
                                            </li>                           
                                        </ul>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $customer_trackings->links() }}
                    </div>
                </div>
            </div>
        </div>
       
    
    {{-- Customer Tracking ends --}}
</x-layout.default>
