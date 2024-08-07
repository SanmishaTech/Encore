<x-layout.default>
    <x-add-button :link="route('roi_accountability_reports.create')" />    
    <br><br>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">ROI Accountability Report</h5>
                <div class="flex items-center">
                    <form action="{{ route('roi_accountability_reports.search') }}" method="get" class="flex items-center">
                        <input type="text" name="search" value="{{ request()->get('search') }}" placeholder="search" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    {{ $roi_accountability_reports->links() }}
                    <br>
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
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("multicolumn", () => ({
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
