<x-layout.default>    
    <x-add-button :link="route('chemists.create')" />
    <x-excel-button :link="route('chemists.import')" />
    <br><br>
    <div x-data="form">        
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Chemists</h5>
                <div class="flex items-center">
                    <form action="{{ route('chemists.search') }}" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search chemists" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" value="{{ request()->get('search') }}" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Chemist Name</th>
                                <th>Employee Name</th>
                                <th>Territory Name</th>
                                <th>Class</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Contact Person</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chemists as $chemist)
                                <tr>                    
                                    <td>{{ $chemist->chemist }}</td>
                                    <td>{{ @$chemist->employee->name }}</td>
                                    <td>{{ @$chemist->territory->name }}</td>
                                    <td>{{ $chemist->class }}</td>
                                    <td>{{ $chemist->email }}</td>
                                    <td>{{ $chemist->contact_no_1 }}</td>
                                    <td>{{ $chemist->contact_person }}</td>
                                    <td class="float-right">
                                        <ul class="flex items-center gap-2" >
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-edit-button :link=" route('chemists.edit', $chemist->id)" />                               
                                            </li>
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-delete-button :link=" route('chemists.destroy',$chemist->id)" />  
                                            </li>   
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $chemists->links() }}
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
