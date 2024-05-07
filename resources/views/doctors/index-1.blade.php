<x-layout.default>
    <div x-data="multicolumn">        
        <x-add-button :link="route('doctors.create')" />
        <x-excel-button :link="route('doctors.import')" />
        <div class="panel mt-6 table-responsive">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Doctors
            </h5>
            <table id="myTable" class="whitespace-nowrap table-hover">
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
            </table>
            {{ $doctors->links() }}
        </div>
    </div>
    
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("multicolumn", () => ({
                datatable: null,
                init() {
                    this.datatable = new simpleDatatables.DataTable('#myTable', {
                        data: {
                            headings: ["Doctor Name", "Email", "Contact No", "Hospital Name", "Type", "Action"],
                        },
                        searchable: true,
                    })
                }
            }));
        });
    </script>


</x-layout.default>
