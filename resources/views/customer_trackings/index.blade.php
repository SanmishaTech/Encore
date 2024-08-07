<x-layout.default>
    @role(['Admin','Marketing Executive'])
        <x-add-button :link="route('customer_trackings.create')" />
    @endrole
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Customer Trackings</h5>
                <div class="flex items-center">
                    <form action="{{ route('customer_trackings.search') }}" method="get" class="flex items-center">
                        <input type="text" name="search" value="{{ request()->get('search') }}" placeholder="search" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    {{ $customer_trackings->links() }}
                    <br>
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Marketing Executive</th>
                                <th>Area Manager</th>
                                <th>Zonal Manager</th>
                                <th>Doctor</th>
                                <th>Amount</th>
                                <th style="float:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer_trackings as $customer_tracking)
                            <tr> 
                                <td>{{ @$customer_tracking->Manager->name }}</td>           
                                <td>{{ @$customer_tracking->Manager->AreaManager->name }}</td>
                                <td>{{ @$customer_tracking->Manager->ZonalManager->name }}</td>
                                <td>{{ @$customer_tracking->CustomerTrackingDetail->first()->Doctor->doctor_name }}</td>
                                <td>&#8377; {{ @$customer_tracking->amount }}</td> 
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('customer_trackings.edit', ['customer_tracking'=> $customer_tracking->id])" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('customer_trackings.destroy', ['customer_tracking'=> $customer_tracking->id] )" />  
                                        </li>                           
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $customer_trackings->links() }}
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
