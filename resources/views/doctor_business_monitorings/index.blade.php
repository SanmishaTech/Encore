<x-layout.default>    
    <div x-data="multicolumn"> 
        <x-add-button :link="route('doctor_business_monitorings.create')" />
        <div class="panel mt-6 table-responsive">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Core Doctor Business Monitoring</h5>
            <table id="myTable" class="whitespace-nowrap">
                @foreach ($doctor_business_monitorings as $doctor_business_monitoring)
                <tr>   
                    <td>{{ @$doctor_business_monitoring->GrantApproval->code }}</td>           
                    <td>{{ @$doctor_business_monitoring->GrantApproval->Manager->name }}</td>           
                    <td>{{ @$doctor_business_monitoring->GrantApproval->Manager->AreaManager->name }}</td>
                    <td>{{ @$doctor_business_monitoring->GrantApproval->Manager->ZonalManager->name }}</td>
                    <td>{{ @$doctor_business_monitoring->GrantApproval->Doctor->doctor_name }}</td>
                    <td>{{ round($doctor_business_monitoring->roi, 2)}} </td>
                    <td style="text-align:right;"> &#8377;  {{ $doctor_business_monitoring->GrantApproval->proposal_amount }}</td>
                    <td style="text-align:right;"> &#8377;  {{ $doctor_business_monitoring->GrantApproval->approval_amount }}</td>
                    <td style="text-align:right;"> &#8377;  {{ $doctor_business_monitoring->total_business_value }}</td>
                    <td style="text-align:right;"> &#8377;  {{ $doctor_business_monitoring->total_expected_value }}</td>
                    <td>
                        {!! $doctor_business_monitoring->status == "Open" ? '<span class="badge bg-info"> Open </span>' : ($doctor_business_monitoring->status == "Level 1 Approved" ? '<span class="badge bg-warning"> Level 1 </span>' : ($doctor_business_monitoring->status == "Level 2 Approved" ? '<span class="badge bg-success"> Level 2</span>' :  ($doctor_business_monitoring->status == "Level 1 Rejected" ? '<span class="badge bg-danger"> Level 1 </span>' : ($doctor_business_monitoring->status == "Level 2 Rejected" ? '<span class="badge bg-danger"> Level 2</span>' : '')) ))  !!}
                    </td>  
                    
                    <td class="float-right">
                        <ul class="flex items-center gap-2" >
                            @role(['Area Manager'])
                            @if($doctor_business_monitoring->status == "Open")
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="/doctor_business_monitorings/approval/{{$doctor_business_monitoring->id }}" class="btn btn-success btn-sm">Approval</a>
                                </li>
                            
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="/doctor_business_monitorings/rejected/{{$doctor_business_monitoring->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                </li>
                            @endif
                            @endrole

                            @role(['Zonal Manager'])
                                @if($doctor_business_monitoring->status == "Level 1 Approved")
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="/doctor_business_monitorings/approval/{{$doctor_business_monitoring->id }}" class="btn btn-success btn-sm">Approval</a>
                                </li>
                               
                                    <li style="display: inline-block;vertical-align:top;">
                                        <a href="/doctor_business_monitorings/rejected/{{$doctor_business_monitoring->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                    </li>
                                @endif
                            @endrole
                            @role(['Admin'])
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="/doctor_business_monitorings/approval/{{$doctor_business_monitoring->id }}" class="btn btn-success btn-sm">Approval</a>
                                </li>
                                    <li style="display: inline-block;vertical-align:top;">
                                        <a href="/doctor_business_monitorings/rejected/{{$doctor_business_monitoring->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                    </li>
                            @endrole
                            @role(['Area Manager', 'Marketing Executive'])
                            @if($doctor_business_monitoring->approval_level_1 == false)
                            <li style="display: inline-block;vertical-align:top;">
                                <x-edit-button :link=" route('doctor_business_monitorings.edit', ['doctor_business_monitoring'=> $doctor_business_monitoring->id])" />                               
                            </li>
                            @endif
                            @endrole
                            @role(['Zonal Manager'])
                                @if($doctor_business_monitoring->approval_level_2 == false)
                                <li style="display: inline-block;vertical-align:top;">
                                    <x-edit-button :link=" route('doctor_business_monitorings.edit', ['doctor_business_monitoring'=> $doctor_business_monitoring->id])" />                               
                                </li>
                                @endif
                            @endrole
                            @role(['Admin'])
                                @if($doctor_business_monitoring->status == "Open")
                                <li style="display: inline-block;vertical-align:top;">
                                    <x-edit-button :link=" route('doctor_business_monitorings.edit', ['doctor_business_monitoring'=> $doctor_business_monitoring->id])" />                               
                                </li>
                                @endif
                            @endrole
                            @role(['Admin'])
                            <li style="display: inline-block;vertical-align:top;">
                                <x-delete-button :link=" route('doctor_business_monitorings.destroy', ['doctor_business_monitoring'=> $doctor_business_monitoring->id] )" />  
                            </li> 
                            @endrole
                        </ul>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("multicolumn", () => ({
                datatable: null,
                id: null,
                open: false,
                init() {
                    this.datatable = new simpleDatatables.DataTable('#myTable', {
                        data: {
                            headings: [
                                "Code", "Marketing Executive", "Area Manager", "Zonal Manager", "Doctor", "ROI", "Amount", "Approved Amount", "Total Business Value", "Total Expected Value", "Status", "Action"
                            ],
                        },
                        searchable: true,
                        perPage: 30,
                        perPageSelect: [10, 20, 30, 50, 100],
                        columns: [{
                            select: 0,
                            order:[['0', "asc"]], 
                        }, ],
                        firstLast: true,
                        firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        labels: {
                            perPage: "{select}"
                        },
                        layout: {
                            top: "{search}",
                            bottom: "{info}{select}{pager}",
                        },
                    })
                },
            }));
        });
    </script>
</x-layout.default>
