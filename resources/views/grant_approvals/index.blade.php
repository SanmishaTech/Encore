<x-layout.default>
    <script src="/assets/js/simple-datatables.js"></script>
    <div x-data="multicolumn">        
        <x-add-button :link="route('grant_approvals.create')" />
        <div class="panel mt-6 table-responsive">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Grant Approvals
            </h5>
            <table id="myTable" class="whitespace-nowrap table-hover">
                @foreach ($grant_approvals as $grant_approval)
                <tr> 
                    <td>{{ @$grant_approval->Manager->name }}</td>           
                    <td>{{ @$grant_approval->AreaManager->name }}</td>
                    <td>{{ @$grant_approval->ZonalManager->name }}</td>
                    <td>{{ @$grant_approval->Doctor->doctor_name }}</td>
                    <td>{{ @$grant_approval->Activity->name }}</td>
                    <td>{{ @$grant_approval->status }}</td>           
                    <td> &#8377;  {{ @$grant_approval->amount }}</td>           
                    <td> &#8377;  {{ @$grant_approval->approval_amount }}</td>           
                    <td class="float-right">
                        <ul class="flex items-center gap-2" >
                            @role(['Admin','ABM'])
                            @if($grant_approval->status == "Open")
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="/grant_approvals/approval/{{$grant_approval->id }}" class="btn btn-success btn-sm">Approval</a>
                                </li>
                            @endif
                            @endrole
                            @role(['Admin','ABM'])
                            @if($grant_approval->status == "Open" || $grant_approval->status == "ABM Approved")
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="/grant_approvals/rejected/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                </li>
                            @endif
                            @endrole
                            @role(['Admin','RBM/ZBM'])
                            @if($grant_approval->status == "ABM Approved")
                            <li style="display: inline-block;vertical-align:top;">
                                <a href="/grant_approvals/approvalSecond/{{$grant_approval->id }}" class="btn btn-success btn-sm">Approval</a>
                            </li>
                            @endif
                            @endrole
                            @role(['Admin','RBM/ZBM'])
                            @if($grant_approval->status == "Open" && $grant_approval->status == "ABM Approved")
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="/grant_approvals/rejectedSecond/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                </li>
                            @endif
                            @endrole
                            @if($grant_approval->status != "Cancel")
                            <li style="display: inline-block;vertical-align:top;">
                                <a href="/grant_approvals/cancel/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Cancel</a>
                            </li>
                            @endif
                            <li style="display: inline-block;vertical-align:top;">
                                <x-edit-button :link=" route('grant_approvals.edit', ['grant_approval'=> $grant_approval->id])" />                               
                            </li>
                            <li style="display: inline-block;vertical-align:top;">
                                <x-delete-button :link=" route('grant_approvals.destroy', ['grant_approval'=> $grant_approval->id] )" />  
                            </li>   
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
                init() {
                    this.datatable = new simpleDatatables.DataTable('#myTable', {
                        data: {
                            headings: ["ME HQ", "ABM", "RBM/ZBM", "Doctor", "Activity",  'Status', 'Amount', 'Approved Amount', "Action"],
                        },
                        searchable: true,
                        perPage: 30,
                        perPageSelect: [10, 20, 30, 50, 100],
                        columns: [{
                            order: [[0, 'asc']]
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
                }
            }));
        });
    </script>


</x-layout.default>
