<x-layout.default>  
    @role(['Admin','Marketing Executive'])
        <x-add-button :link="route('doctor_business_monitorings.create')" />
    @endrole  
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
                                <th>Action</th>
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
                                    {!! $doctor_business_monitoring->status == "Open" ? '<span class="badge bg-info"> Open </span>' : ($doctor_business_monitoring->status == "Level 1 Approved" ? '<span class="badge bg-warning"> Level 1 </span>' : ($doctor_business_monitoring->status == "Level 2 Approved" ? '<span class="badge bg-success"> Level 2</span>' :  ($doctor_business_monitoring->status == "Level 1 Rejected" ? '<span class="badge bg-danger"> Level 1 </span>' : ($doctor_business_monitoring->status == "Level 2 Rejected" ? '<span class="badge bg-danger"> Level 2</span>' : '')) ))  !!}
                                </td>  
                                
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        @role(['Area Manager'])
                                        @if($doctor_business_monitoring->status == "Open")
                                            <li style="display: inline-block;vertical-align:top;">
                                                <!-- <a href="/doctor_business_monitorings/approval/{{$doctor_business_monitoring->id }}" class="btn btn-success btn-sm">Approval</a> -->
                                                <a href="/doctor_business_monitorings/approval_form/{{$doctor_business_monitoring->id }}" class="btn btn-success btn-sm">Approval</a>
                                            </li>
                                        
                                            <li style="display: inline-block;vertical-align:top;">
                                                <a href="/doctor_business_monitorings/rejected/{{$doctor_business_monitoring->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                            </li>
                                        @endif
                                        @endrole

                                        @role(['Zonal Manager'])
                                            @if($doctor_business_monitoring->status == "Open")
                                                <li style="display: inline-block;vertical-align:top;">
                                                    <a href="/doctor_business_monitorings/approval_form/{{$doctor_business_monitoring->id }}" class="btn btn-success btn-sm">Approval</a>
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
                        </tbody>
                    </table>
                    {{ $doctor_business_monitorings->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
               // highlightjs
                codeArr: [],
                toggleCode(name) {
                    if (this.codeArr.includes(name)) {
                        this.codeArr = this.codeArr.filter((d) => d != name);
                    } else {
                        this.codeArr.push(name);

                        setTimeout(() => {
                            document.querySelectorAll('pre.code').forEach(el => {
                                hljs.highlightElement(el);
                            });
                        });
                    }
                }
            }));
        });
    </script>
</x-layout.default>
