<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('free_schemes.index') }}" class="text-primary hover:underline">Free Scheme</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('free_schemes.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Free Scheme</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4"> 
                    @if( auth()->user()->roles->pluck('name')->first() == "Marketing Executive")
                        @foreach ($employees as $id=>$employee)
                        <input type="hidden" x-model="employee_id" x-on:change="mehqChange()" name="employee_id"/>
                        <x-text-input class="bg-gray-100 dark:bg-gray-700" value="{{ $employee }}" :label="__('Marketing Executive')" :messages="$errors->get('employee_id')" readonly="true"/>
                        @endforeach
                    @else
                        <div>
                            <label>Marketing Executive:  <span class=text-danger>*</span></label>
                            <select class="form-input" name="employee_id" id="employee_id" x-model="employee_id" @change="mehqChange()">
                            @foreach ($employees as $id=>$employee)                                
                                <option value="{{$id}}">{{$employee}}</option>                                
                            @endforeach                
                            </select> 
                            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                        </div>
                    @endif
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Area Manager')"  :messages="$errors->get('employee_id_2')" x-model="area" readonly="true"/>                       
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Zonal Manager')"  :messages="$errors->get('employee_id_3')" x-model="zone" readonly="true"/>                      
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Doctor: <span class=text-danger>*</span></label>
                            <select class="form-select" name="doctor_id" @change="doctorChange()" x-model="doctor_id">
                                <option value="" disabled selected>Select Doctor</option>
                                @if( auth()->user()->roles->pluck('name')->first() == "Marketing Executive")
                                    @foreach ($doctors as $id=>$doctor)                                
                                        <option value="{{$id}}">{{$doctor}}</option>                                
                                    @endforeach      
                                @else
                                    <template x-for="doctor in doctors" :key="doctor.id">
                                        <option :value="doctor.id" x-text="doctor.doctor_name"></option>
                                    </template>
                                @endif
                            </select>
                        <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" /> 
                    </div>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700"  x-model="mpl_no"  :label="__('MPL No')"  :messages="$errors->get('mpl_no')" readonly="true"/>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700"  x-model="speciality"   :label="__('Speciality')" :messages="$errors->get('speciality')" readonly="true"/>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Location:</label>
                        <select class="form-input" name="location">
                            <option value="">Select Location</option>
                            <option value='HQ'>HQ</option>
                            <option value='Ex-Station'>Ex-Station</option>
                            <option value='Out-Station'>Out-Station</option>                           
                        </select>
                    </div>
                    <x-text-input name="proposal_date" id="proposal_date" value="{{ old('proposal_date') }}" :label="__('Date')" x-model="proposal_date" x-on:change.debounce="dateChange()" :messages="$errors->get('proposal_date')"/>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Proposal Month')" x-model="proposal_month" name="proposal_month" :messages="$errors->get('proposal_month')" readonly="true"/> 
                        <div>
                            <label>Free Scheme Type: <span class=text-danger>*</span></label>
                            <select class="form-input" name="free_scheme_type">
                                <option value="">Select Type</option>
                                <option value='Reimburse'>Reimburse</option>
                                <option value='Regular'>Regular</option>                           
                            </select>
                            <x-input-error :messages="$errors->get('free_scheme_type')" class="mt-2" /> 

                        </div>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Stockist :</label>
                        <select class="form-select" name="stockist_id" id="stockist_id" x-model="stockist_id" @change="stockistChange()">
                            <option value="">Select Stockist</option>
                            @foreach ($stockists as $id => $stockist)
                                <option value="{{$id}}">{{$stockist}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('stockist_id')" class="mt-2" /> 
                    </div>
                    <x-text-input :label="__('Contact No')" x-model="stockist_contact_no" :messages="$errors->get('contact_no')" class="bg-gray-100 dark:bg-gray-700" readonly="true"/>
                    <div>
                        <label>Chemist :</label>
                        <select class="form-input" id="chemist_id" name="chemist_id" @change="chemistChange()" x-model="chemist_id">
                            <option value="">Select Chemist</option>
                            @foreach ($chemists as $id => $chemist)
                                <option value="{{$id}}">{{$chemist}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('chemist_id')" class="mt-2" /> 
                    </div>
                    <x-text-input :label="__('Contact No')" :messages="$errors->get('contact_no')" x-model="chemist_contact_no" class="bg-gray-100 dark:bg-gray-700" readonly="true"/>
                </div>       
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Open Scheme:</label>
                        <select class="form-input" name="open_scheme">
                            <option value="" >Select Open scheme</option>
                            <option value='Yes'>Yes</option>
                            <option value='No'>No</option>                           
                        </select>
                    </div>
                    <div>
                        <label>Scheme:</label>
                        <select class="form-input" name="scheme">
                            <option selected disabled>Select Scheme% </option>
                            @for($i = 0; $i <= 100; $i++)
                                <option value="{{ $i }}"> {{ $i }}%</option>
                            @endfor
                        </select>
                        <x-input-error :messages="$errors->get('scheme')" class="mt-2" /> 
                    </div>    
                    <div>
                        <label>CRM Done:</label>
                        <select class="form-input" name="crm_done">
                            <option value="">Select CRM Done</option>
                            <option value='Yes'>Yes</option>
                            <option value='No'>No</option>                           
                        </select>
                    </div>
                    <div>
                        <label>Dr Own Counter:</label>
                        <select class="form-input" name="dr_own_counter">
                            <option value="">Select Counter</option>
                            <option value='Yes'>Yes</option>
                            <option value='No'>No</option>                           
                        </select>
                    </div>           
                </div>
            </div>
            <div class="panel table-responsive">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light"> Add Products</h5>
                </div>
                <div class="flex xl:flex-row flex-col gap-2.5">
                    <div class="panel px-0 flex-1 py-1 ltr:xl:mr-6 rtl:xl:ml-6">
                        <div class="mt-8">
                            <template x-if="freeSchemeDetails">
                                <div class="table-responsive">
                                    <table class="table-hover" width="100%">
                                        <thead>
                                            <tr  width="100%">
                                                <th>&nbsp; #</th>
                                                <th>Products</th>
                                                <th>NRV</th>
                                                <th>Quantity</th>
                                                <th>Free Quantity</th>
                                                <th>Free %</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-if="freeSchemeDetails.length <= 0">
                                                <tr >
                                                    <td colspan="5" class="!text-center font-semibold">No Data Available
                                                    </td>
                                                </tr>
                                            </template>
                                            <template x-for="(freeSchemeDetail, i) in freeSchemeDetails" :key="i">
                                                <tr>
                                                    <td>
                                                        <button type="button" @click="removeItem(freeSchemeDetail)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                height="24px" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="w-5 h-5">
                                                                <line x1="18" y1="6" x2="6"
                                                                    y2="18"></line>
                                                                <line x1="6" y1="6" x2="18"
                                                                    y2="18"></line>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <select required class="form-input" x-model="freeSchemeDetail.product_id" x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][product_id]`"  x-on:change="productChange()">
                                                            <option value="" disabled selected>Select Product</option>
                                                                @foreach ($products as $id => $product)
                                                                    <option value="{{$id}}"> {{$product}} </option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" /> 
                                                    </td>
                                                    <td>
                                                        <x-text-input class="bg-gray-100 dark:bg-gray-700" readonly="true" x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][nrv]`"  :messages="$errors->get('nrv')" x-model="freeSchemeDetail.nrv"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][qty]`"  :messages="$errors->get('qty')" x-model="freeSchemeDetail.qty" @change="calculateVal()" required/>
                                                    </td> 
                                                    <td>
                                                        <x-text-input x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][free_qty]`"  :messages="$errors->get('free_qty')" x-model="freeSchemeDetail.free_qty" required/>
                                                    </td> 
                                                    <td>                                                      
                                                        <select required class="form-input" x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][free]`" x-model="freeSchemeDetail.free" @change="calculateVal()">
                                                        <option value="" selected> Free% </option>
                                                        @for ($i = 0; $i <= 100; $i++)
                                                            <option value="{{ $i }}"> {{ $i }}%</option>
                                                        @endfor
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][val]`"  :messages="$errors->get('val')" x-model="freeSchemeDetail.val" @change="calculateTotal()"/>
                                                    </td>
                                                </tr>
                                            </template>
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn btn-info" @click.prevent="addItem()">+ </button>
                                                </td>
                                            </tr>
                                        </tbody>           
                                        <tfoot  style="background-color: #FFFFF;">
                                            <tr>
                                                <th colspan="6" style="text-align:right;">Total Amount: </th>
                                                <td>               
                                                    <x-text-input class="form-input bg-gray-100 dark:bg-gray-700"  readonly="true" :messages="$errors->get('amount')"  name="amount" x-model="amount"/>
                                                </td>
                                            </tr>
                                        </tfoot>                
                                    </table>
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                                        <div style="flex: 1;">
                                            <p style="font-size: 16px; font-weight: bold; color: #333; padding: 10px;">
                                                Proof Of Order:
                                            </p>
                                            <input type="file" name="proof_of_order" id="proof_of_order" style="margin-top: 5px; margin-left:10px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; width: 100%;">
                                        </div>
                                        <div style="flex: 1; margin-left: 10px;">
                                            <p style="font-size: 16px; font-weight: bold; color: #333; padding: 10px;">
                                                Proof Of Delivery:
                                            </p>
                                            <input type="file" name="proof_of_delivery" id="proof_of_delivery" style="margin-top: 5px; margin-left:10px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; width: 94%;">
                                        </div>
                                    </div>
                                    <div>
                                        <label style="margin:0 0 10px 10px; font-size: 16px; font-weight: bold; color: #333;" for="remarks">Remark:</label>
                                        <input type="text" style="width:98%; margin:0 0 10px 10px; border: 1px solid #ccc;" class="form-input" name="remark" placeholder="Enter Remark">
                                    </div>
                                    {{-- <x-text-input :label="__('Contact No')" :messages="$errors->get('contact_no')" x-model="chemist_contact_no" class="bg-gray-100 dark:bg-gray-700" readonly="true"/> --}}

                                    {{-- <div style="display: flex; justify-content: space-around;">
                                        <div>
                                            @if (@$free_scheme->proof_of_order)
                                                <a href="{{ asset('storage/FreeScheme/proof_of_order/' . $free_scheme->proof_of_order) }}" target="_blank" style="text-decoration: none; color: #007bff; font-weight: bold;">
                                                    View Proof of Order
                                                </a>
                                            @endif
                                        </div>
                                        <div>
                                            @if ($free_scheme->proof_of_delivery)
                                                <a href="{{ asset('storage/FreeScheme/proof_of_delivery/' . $free_scheme->proof_of_delivery) }}" target="_blank" style="text-decoration: none; color: #007bff; font-weight: bold;">
                                                    View Proof of Delivery
                                                </a>
                                            @endif
                                        </div>
                                    </div> --}}
                                </div>
                            </template>                                                
                        </div>                            
                    </div>                    
                </div>
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>                    
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('free_schemes.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>         
            </div>            
        </form>         
    </div>
</div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
document.addEventListener("alpine:init", () => {
    Alpine.data('data', () => ({   
        init() {
            this.amount = 0;
            var options = {
                searchable: true
            };
            NiceSelect.bind(document.getElementById("stockist_id"), options);
            NiceSelect.bind(document.getElementById("chemist_id"), options);
            flatpickr(document.getElementById('proposal_date'), {
                dateFormat: 'd/m/Y',
            });
            
            @if(auth()->user()->roles->pluck('name')->first() == "Marketing Executive")
                this.employee_id = {{ auth()->user()->id}};
                this.mehqChange();
            @else
                NiceSelect.bind(document.getElementById("employee_id"), options);
            @endif
        },   

        doctor_id: '',
        doctorData: '',
        location: '',
        speciality: '',
        mpl_no: '',
        async doctorChange() {
            this.doctorData = await (await fetch('/doctors/'+ this.doctor_id, {                
            method: 'GET',
            headers: {
                'Content-type': 'application/json;',
            },
            })).json();
            this.mpl_no = this.doctorData.mpl_no;
            this.location = this.doctorData.type;
            this.speciality = this.doctorData.speciality;
        },

        chemistData:'',
        chemist_id:'',
        chemist_contact_no:'',
        async chemistChange() {
            this.chemistData = await (await fetch('/chemists/'+ this.chemist_id, {                
            method: 'GET',
            headers: {
                'Content-type': 'application/json;',
            },
            })).json();
            this.chemist_contact_no = this.chemistData.contact_no_1;
        },

        stockistData:'',
        stockist_id:'',
        stockist_contact_no:'',
        async stockistChange() {
            this.stockistData = await (await fetch('/stockists/'+ this.stockist_id, {                
            method: 'GET',
            headers: {
                'Content-type': 'application/json;',
            },
            })).json();
            this.stockist_contact_no = this.stockistData.contact_no;
        },


        employee_id: '',
        doctors:'',
        zone: '',
        area: '',
        async mehqChange() {
            this.data = await (await fetch('/employees/getEmployees/'+ this.employee_id, {
                
            method: 'GET',
            headers: {
                'Content-type': 'application/json;',
            },
            })).json();
            this.area = this.data.area_manager.name;
            this.zone = this.data.zonal_manager.name;
            
            this.doctors = await (await fetch('/doctors/getDoctors/'+ this.employee_id, {
                method: 'GET',
                headers: {
                    'Content-type': 'application/json;',
                },
            })).json();
        },

        proposal_date : '',
        proposal_month: '',
        dateChange(){    
            this.proposal_month = moment(this.proposal_date, 'DD/MM/YYYY').format("MMM / YYYY");
        },

        product_id: '',
        nrv: '',
        async productChange() {                    
            this.freeSchemeDetail.nrv = await (await fetch('/products/'+ this.freeSchemeDetail.product_id, {
            method: 'GET',
            headers: {
                'Content-type': 'application/json;',
            },
            })).json();
            
        },

        freeSchemeDetails: [],
        addItem() {
            let maxId = 0;
            if (this.freeSchemeDetails && this.freeSchemeDetails.length) {
                maxId = this.freeSchemeDetails.reduce((max, character) => (character.id > max ? character
                    .id : max), this.freeSchemeDetails[0].id);
            }
            this.freeSchemeDetails.push({
                id: maxId + 1,
                product_id: '',
                nrv: '',
                qty: '',
                free_qty: '',
                free: '',
                val: '',
            });
            this.calculateTotal();
        }, 
        
        removeItem(freeSchemeDetail) {
            this.freeSchemeDetails = this.freeSchemeDetails.filter((d) => d.id != freeSchemeDetail.id);
            this.calculateVal();
            this.calculateFQtyVal();
            this.calculateTotal();
        },

        calculateVal(){
            let val = 0; 
            if(!isNaN(this.freeSchemeDetail.qty) && this.freeSchemeDetail.qty != ''){
                val = this.freeSchemeDetail.qty * this.freeSchemeDetail.nrv;          
                this.freeSchemeDetail.val = val.toFixed(2);
            } 
            this.calculateTotal();
        },

        calculateFQtyVal(){
            let val = 0; 
            if(!isNaN(this.freeSchemeDetail.free_qty) && this.freeSchemeDetail.free_qty != ''){
                val = this.freeSchemeDetail.free_qty * this.freeSchemeDetail.nrv;          
                this.freeSchemeDetail.val = val.toFixed(2);
            } 
            this.calculateTotal();
        },

        calculateTotal() {               
            let amount = 0; 
            this.freeSchemeDetails.forEach(freeSchemeDetail => {                
                amount = parseFloat(amount) + parseFloat(freeSchemeDetail.val);
            });                               
            if(!isNaN(amount)){
                this.amount = amount.toFixed(2);
            }     
        },
    }));
});
</script>
</x-layout.default>
