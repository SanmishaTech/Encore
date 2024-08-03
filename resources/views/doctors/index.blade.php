<x-layout.default>
    <x-add-button :link="route('doctors.create')" />
    <x-excel-button :link="route('doctors.import')" />
    <br><br>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Doctors</h5>
                <div class="flex items-center">
                    <form action="{{ route('doctors.search') }}" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search doctors" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Doctor Name</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Hospital Name</th>
                                <th>Type</th>
                                <th style="float:right;">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                                <tr>  
                                    <td>
                                        <div class="flex items-center font-semibold">
                                            <div class="p-0.5 bg-white-dark/30 rounded-full w-max ltr:mr-2 rtl:ml-2">
                                                <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ $doctor->doctor_name }}&rounded=true" />
                                            </div>
                                            {{ $doctor->doctor_name }}
                                        </div>             
                                    </td> 
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->contact_no_1 }} <br> {{ $doctor->contact_no_2 }}</td>
                                    <td>{{ $doctor->hospital_name }}</td>
                                    <td>{{ $doctor->type }}</td>                    
                                    <td class="float-right">
                                        <ul class="flex items-center gap-2" >
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-edit-button :link=" route('doctors.edit', $doctor->id)" />                               
                                            </li>
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-delete-button :link=" route('doctors.destroy', $doctor->id)" />  
                                            </li>   
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $doctors->links() }}
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
