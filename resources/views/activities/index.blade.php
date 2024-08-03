<x-layout.default>    
    <!-- <script src="/assets/js/simple-datatables.js"></script> -->
    <x-add-button :link="route('activities.create')" />
    <x-excel-button :link="route('activities.import')" />
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Activities</h5>
                <div class="flex items-center">
                    <form action="{{ route('activities.search') }}" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search activities" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th style="float:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($activities as $activity)
                        <tr>                    
                            <td>{{ $activity->name }}</td>
                            <td class="float-right">
                                <ul class="flex items-center gap-2" >
                                    <li style="display: inline-block;vertical-align:top;">
                                        <x-edit-button :link=" route('activities.edit', $activity->id)" />                               
                                    </li>
                                    <li style="display: inline-block;vertical-align:top;">
                                        <x-delete-button :link=" route('activities.destroy',$activity->id)" />  
                                    </li>   
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $activities->links() }}
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
