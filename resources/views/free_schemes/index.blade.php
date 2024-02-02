<x-layout.default>
    <div x-data="multicolumn">        
        @role(['Admin','Marketing Executive'])
            <x-add-button :link="route('free_schemes.create')" />
        @endrole
        <div class="panel mt-6 table-responsive">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Free Schemes
            </h5>
            <table id="myTable" class="whitespace-nowrap table-hover">
                @foreach ($free_schemes as $free_scheme)
                <tr> 
                    <td>{{ @$free_scheme->code }}</td> 
                    <td>{{ @$free_scheme->Manager->name }}</td>           
                    <td>{{ @$free_scheme->Manager->AreaManager->name }}</td>
                    <td>{{ @$free_scheme->Manager->ZonalManager->name }}</td>
                    <td>{{ @$free_scheme->Doctor->doctor_name }}</td>
                    <td>{{ @$free_scheme->Stockist->name }}</td>
                    <td>{{ @$free_scheme->Chemist->name }}</td>  
                              
                    <td class="float-right">
                        <ul class="flex items-center gap-2" >
                            <li style="display: inline-block;vertical-align:top;">
                                <x-edit-button :link=" route('free_schemes.edit', ['free_scheme'=> $free_scheme->id])" />                               
                            </li>
                            <li style="display: inline-block;vertical-align:top;">
                                <x-delete-button :link=" route('free_schemes.destroy', ['free_scheme'=> $free_scheme->id] )" />  
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
                id: null,
                datatable: null,
                open: false,

                init() {
                    this.open= false;
                    this.datatable = new simpleDatatables.DataTable('#myTable', {
                        data: {
                            headings: ["Marketing Executive", "Area Manager",  "Zonal Manager", "Doctor", "Stockist",  "Chemist", "Action"],
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
