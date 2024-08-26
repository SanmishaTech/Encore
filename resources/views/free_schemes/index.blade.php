<x-layout.default>
    @role(['Admin','Marketing Executive'])
        <x-add-button :link="route('free_schemes.create')" />
    @endrole

    @if(session('emailSuccess'))
    <div style="width: 100%; background-color: green; color: white; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; font-weight:700">
        {{ session('emailSuccess') }}
    </div>
    @endif
    <br><br>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Free Schemes</h5>
                <div class="flex items-center gap-4"> <!-- Added gap-4 for spacing -->
                    <form action="{{ route('free_schemes.search') }}" method="get" class="flex items-center">
                        <select name="status" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                            <option value="">Status</option>
                            <option value="Open" {{ request()->get('status') == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="Level 1 Approved" {{ request()->get('status') == 'Level 1 Approved' ? 'selected' : '' }} >Level 1 Approved</option>
                            <option value="Level 2 Approved" {{ request()->get('status') == 'Level 2 Approved' ? 'selected' : '' }}>Level 2 Approved</option>
                            <option value="Level 3 Approved" {{ request()->get('status') == 'Level 3 Approved' ? 'selected' : '' }}>Level 3 Approved</option>
                            <option value="Level 1 Rejected" {{ request()->get('status') == 'Level 1 Rejected' ? 'selected' : '' }}>Level 1 Rejected</option>
                            <option value="Level 2 Rejected" {{ request()->get('status') == 'Level 2 Rejected' ? 'selected' : '' }}>Level 2 Rejected</option>
                            <option value="Level 3 Rejected" {{ request()->get('status') == 'Level 3 Rejected' ? 'selected' : '' }}>Level 3 Rejected</option>
                        </select>
                        <input type="text" name="search" placeholder="search" value="{{ request()->get('search') }}" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Search</button>
                    </form>
                   
                </div>
            </div>


            <div class="mt-6">
                <div class="table-responsive">
                    {{ $free_schemes->links() }}
                    <br>
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
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                    {!! $free_scheme->free_scheme_type == "Reimburse" ? '<span class="badge bg-dark"> Reimburse </span>' : ($free_scheme->free_scheme_type == "Regular" ? '<span class="badge bg-warning">Regular</span>' : '')  !!}
                                </td>
                                <td class="whitespace-nowrap" >
                                    {!! $free_scheme->status == "Open" ? '<span class="badge bg-info"> Open </span>' : ($free_scheme->status == "Level 1 Approved" ? '<span class="badge bg-warning"> Level 1 Approved</span>' : ($free_scheme->status == "Level 2 Approved" ? '<span class="badge bg-success"> Level 2 Approved</span>': ($free_scheme->status == "Level 3 Approved" ? '<span class="badge bg-success"> Level 3 Approved</span>' :  ($free_scheme->status == "Level 1 Rejected" ? '<span class="badge bg-danger"> Level 1 Rejected </span>' : ($free_scheme->status == "Level 2 Rejected" ? '<span class="badge bg-danger"> Level 2 Rejected</span>' : ($free_scheme->status == "Level 3 Rejected" ? '<span class="badge bg-danger"> Level 3 Rejected</span>' : '')) ))))  !!}
                                </td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        {{-- start --}}
                                        @role(['Area Manager'])
                                        @if($free_scheme->status == "Open")
                                        <li style="display: inline-block;vertical-align:top;">
                                            <a href="/free_schemes/approval_form/{{$free_scheme->id }}" class="btn btn-success btn-sm">Approval</a>
                                        </li>
                                            <li style="display: inline-block;vertical-align:top;">
                                                <a href="/free_schemes/rejected/{{$free_scheme->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                            </li>
                                        @endif
                                        @endrole

                                        @role(['Zonal Manager'])
                                            @if($free_scheme->status == "Open" || $free_scheme->status == "Level 1 Approved")
                                            <li style="display: inline-block;vertical-align:top;">
                                                <a href="/free_schemes/approval_form/{{$free_scheme->id }}" class="btn btn-success btn-sm">Approval</a>
                                            </li>
                                            <!-- <li style="display: inline-block;vertical-align:top;">
                                                <a href="#" class="btn btn-success btn-sm"  @click="toggle({{$free_scheme->id }})">Approval</a>
                                            </li> -->
                                            <li style="display: inline-block;vertical-align:top;">
                                                <a href="/free_schemes/rejected/{{$free_scheme->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                            </li>
                                            @endif
                                        @endrole
                                            {{-- g --}}
                                        @role(['Root']) 
                                        @if($free_scheme->status == "Level 2 Approved")
                                        <li style="display: inline-block;vertical-align:top;">
                                            <a href="/free_schemes/approval_form/{{$free_scheme->id }}" class="btn btn-success btn-sm">Approval</a>
                                        </li>
                                        <!-- <li style="display: inline-block;vertical-align:top;">
                                            <a href="#" class="btn btn-success btn-sm"  @click="toggle({{$free_scheme->id }})">Approval</a>
                                        </li> -->
                                        <li style="display: inline-block;vertical-align:top;">
                                            <a href="/free_schemes/rejected/{{$free_scheme->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                        </li>
                                        @endif
                                    @endrole

                                        @role(['Admin'])
                                            <li style="display: inline-block;vertical-align:top;">
                                                <a href="#" class="btn btn-success btn-sm"  @click="toggle({{$free_scheme->id }})">Approval</a>
                                            </li>
                                                <li style="display: inline-block;vertical-align:top;">
                                                    <a href="/free_schemes/rejected/{{$free_scheme->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                                </li>
                                        @endrole
                                        {{-- end --}}
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('free_schemes.edit', ['free_scheme'=> $free_scheme->id])" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('free_schemes.destroy', ['free_scheme'=> $free_scheme->id] )" />  
                                        </li>   
                                        @role(['Root'])
                                        @if($free_scheme->approval_level_3 == 1)
                                        <li style="display: inline-block;vertical-align:top;">
                                            <a href="/free_schemes/resend_email/{{$free_scheme->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" style="display: inline-block;vertical-align:top;" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                              </svg></a>   
                                        </li> 
                                        @endif
                                        @endrole                 
                                    </ul>
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
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                id: null,
                datatable: null,
                open: false,

                init() {
                    this.open= false;
                    this.datatable = new simpleDatatables.DataTable('#myTable', {
                        data: {
                            headings: ["Marketing Executive", "Area Manager",  "Zonal Manager", "Doctor", "Stockist",  "Chemist", "Amount", "Action"],
                        },
                        searchable: true,
                        perPage: 30,
                        perPageSelect: [10, 20, 30, 50, 100],
                        columns: [{
                            order: [0, 'desc']
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
               
                toggle(x) {
                    console.log(x);
                    this.id = x;
                    this.open = !this.open;
                },
            }));
        });
    </script>
</x-layout.default>
