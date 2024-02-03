<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('free_schemes.index') }}" class="text-primary hover:underline">Free Scheme</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('free_schemes.update', ['free_scheme' => $free_scheme->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Free Scheme</h5>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">  
                    <div>
                        <label>Marketing Executive :</label>
                        <select class="form-input" name="employee_id" x-model="employee_id" @change="mehqChange()">
                            <option>Select Marketing Executive</option>
                            @foreach ($employees as $id=>$employee)                                
                                <option value="{{$id}}" {{ $id ? ($id == $free_scheme->employee_id ? 'Selected' : '') : '' }}>{{$employee}}</option>                                
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_1')" class="mt-2" />
                    </div>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Area Manager')"  :messages="$errors->get('employee_id_2')" x-model="area" readonly="true"/>                       
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Zonal Manager')"  :messages="$errors->get('employee_id_2')" x-model="zone" readonly="true"/>                      
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Doctor: <span class=text-danger>*</span></label>
                            <select class="form-select" name="doctor_id" @change="doctorChange()" x-model="doctor_id">                                
                                @if(auth()->user()->roles->pluck('name')->first() == "Marketing Executive")
                                    <option>Select Doctor</option>
                                    @foreach ($doctors as $id=>$doctor)                                
                                        <option value="{{$id}}">{{$doctor}}</option>                                
                                    @endforeach      
                                @else
                                    <template x-for="doctor in doctors" :key="doctor.id">
                                        <option :value="doctor.id" x-text="doctor.doctor_name" :selected='doctor.id == doctor_id' selected="selected"></option>
                                    </template>
                                @endif
                            </select>
                        <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" /> 
                    </div>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" x-model="mpl_no" :label="__('MPL No')"  :messages="$errors->get('mpl_no')" readonly="true"/>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700"  x-model="speciality"   :label="__('Speciality')"  :messages="$errors->get('speciality')" readonly="true"/>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Location:</label>
                        <select class="form-input" name="location">
                            <option >Select Location</option>
                            <option value='HQ'  @if ($free_scheme->location =='HQ') {{ 'Selected' }} @endif>HQ</option>
                            <option value='Ex-Station'  @if ($free_scheme->location == 'Ex-Station') {{ 'Selected' }} @endif>Ex-Station</option>
                            <option value='Out-Station'  @if ($free_scheme->location == 'Out-Station') {{ 'Selected' }} @endif>Out-Station</option>                           
                        </select>
                    </div>
                    <x-text-input name="proposal_date" id="proposal_date" value="{{ old('proposal_date', $free_scheme->proposal_date) }}"  x-model="proposal_date" x-on:change.debounce="dateChange()" :label="__('Proposal Date')"  :messages="$errors->get('proposal_date')"/>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Proposal Month')" x-model="proposal_month" name="proposal_month" :messages="$errors->get('proposal_month')" readonly="true"/> 
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Stockist :</label>
                        <select class="form-input" name="stockist_id">
                            <option>Select Stockist</option>
                            @foreach ($stockists as $id => $stockist)
                                <option value="{{$id}}" {{ $free_scheme->stockist_id ? ($free_scheme->stockist_id == $id ? 'Selected' : '') : '' }}>{{$stockist}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('stockist_id')" class="mt-2" /> 
                    </div>
                    <x-text-input :label="__('Contact No')" x-model="stockist_contact_no" :messages="$errors->get('contact_no')" class="bg-gray-100 dark:bg-gray-700" readonly="true"/>
                    <div>
                        <label>Chemist :</label>
                        <select class="form-input" name="chemist_id" @change="chemistChange()" x-model="chemist_id">
                            <option>Select Chemist</option>
                            @foreach ($chemists as $id => $chemist)
                                <option value="{{$id}}"  {{ $free_scheme->chemist_id ? ($free_scheme->chemist_id == $id ? 'Selected' : '') : '' }}>{{$chemist}}</option>
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
                            <option >Select Open scheme</option>
                            <option value='Yes' @if ($free_scheme->open_scheme =='Yes') {{ 'Selected' }} @endif>Yes</option>
                            <option value='No' @if ($free_scheme->open_scheme =='No') {{ 'Selected' }} @endif>No</option>                           
                        </select>
                    </div>
                    <div>
                        <label>Scheme:</label>
                        <select class="form-input" name="scheme">
                            <option>Select Scheme% </option>
                            @for($i = 1; $i < 100; $i++)
                                <option value="{{ $i }}" {{ $i ? ($i == $free_scheme->scheme ? 'selected' : '') : '' }}> {{ $i }}%</option>
                            @endfor
                        </select>
                    </div>    
                    <div>
                        <label>CRM Done:</label>
                        <select class="form-input" name="crm_done">
                            <option >Select CRM Done</option>
                            <option value='Yes' @if ($free_scheme->crm_done =='Yes') {{ 'Selected' }} @endif>Yes</option>
                            <option value='No' @if ($free_scheme->crm_done =='No') {{ 'Selected' }} @endif>No</option>                           
                        </select>
                    </div>
                    <div>
                        <label>Dr Own Counter:</label>
                        <select class="form-input" name="dr_own_counter">
                            <option >Select Counter</option>
                            <option value='Yes' @if ($free_scheme->dr_own_counter =='Yes') {{ 'Selected' }} @endif>Yes</option>
                            <option value='No' @if ($free_scheme->dr_own_counter =='No') {{ 'Selected' }} @endif>No</option>                           
                        </select>
                    </div>           
                </div>        
            </div>
            <div class="panel table-responsive">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light"> Add Products</h5>
                </div>
                <div>
                    <div class="flex xl:flex-row flex-col gap-1">
                        <div class="panel px-0 flex-1  ltr:xl:mr-6 rtl:xl:ml-6">
                            <div class="mt-8">
                                <div class="table-responsive">
                                    <table class="table-hover">
                                        <thead>
                                            <tr width="100%">
                                                <th>&nbsp; #</th>
                                                <th>Products</th>
                                                <th>NRV</th>
                                                <th>Quantity</th>
                                                <th>Free %</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-if="productDetails.length <= 0">
                                                <tr >
                                                    <td colspan="5" class="!text-center font-semibold">No Data Available
                                                    </td>
                                                </tr>
                                            </template>
                                            <template x-for="(productDetail, i) in productDetails" :key="i">
                                                <tr>
                                                    <td>
                                                        <button type="button" @click="removeItem(productDetail)">
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
                                                        <input type="hidden" class="form-input min-w-[230px]" x-model="productDetail.id" x-bind:name="`product_details[${productDetail.id}][id]`"/>
                                                        <select class="form-input" name="product_id" x-model="productDetail.product_id" x-bind:name="`product_details[${productDetail.id}][product_id]`"  x-on:change="productChange()">
                                                            <option>Select Product</option>
                                                                @foreach ($products as $id => $product)
                                                                    <option value="{{$id}}"
                                                                    {{ $id ? ($id == $free_scheme->product_id ? 'selected' : '') : '' }}> {{$product}} </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <x-text-input   class="bg-gray-100 dark:bg-gray-700" readonly="true" x-bind:name="`product_details[${productDetail.id}][nrv]`"  :messages="$errors->get('nrv')" x-model="productDetail.nrv"/>
                                                    </td>   
                                                    <td>
                                                        <x-text-input x-bind:name="`product_details[${productDetail.id}][qty]`"  :messages="$errors->get('qty')" x-model="productDetail.qty" @change="calculateVal()"/>
                                                    </td>                                                
                                                    <td>                                                       
                                                        <select class="form-input" style="width:100px;" x-bind:name="`product_details[${productDetail.id}][free]`" x-model="productDetail.free"  @change="calculateVal()">
                                                            <option> Free </option>
                                                            @for ($i = 1; $i < 100; $i++)
                                                                <option value="{{ $i }}" {{ $i ? ($i == $free_scheme->free ? 'selected' : '') : '' }}> {{ $i }}% </option>
                                                            @endfor
                                                        </select>
                                                    </td>                                                    
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][val]`"  :messages="$errors->get('val')" x-model="productDetail.val" @change="calculateTotal()"/>
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
                                                <th colspan="5" style="text-align:right;">Total Amount: </th>
                                                <td>               
                                                    <x-text-input class="form-input bg-gray-100 dark:bg-gray-700" x-model="amount" readonly="true" :messages="$errors->get('amount')" value="{{ old('amount', $free_scheme->amount) }}" name="amount"/>
                                                </td>
                                            </tr>                                           
                                        </tfoot>                                   
                                    </table>
                                </div>
                            </div>                            
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
            flatpickr(document.getElementById('proposal_date'), {
                dateFormat: 'd/m/Y',
            });           

            @if($free_scheme->doctor_id)
                this.doctor_id = {{ $free_scheme->doctor_id }};
                this.doctorChange();
            @endif

            @if($free_scheme->employee_id)
                this.employee_id ={{ $free_scheme->employee_id }};
                this.mehqChange();
            @endif

            @if($free_scheme->chemist_id)
                this.chemist_id = {{ $free_scheme->chemist_id }};
                this.chemistChange();
            @endif

            @if($free_scheme->stockist_id)
                this.stockist_id = {{ $free_scheme->stockist_id }};
                this.stockistChange();
            @endif
                          
            @if($free_scheme->proposal_date)
                this.proposal_date ='{{  $free_scheme->proposal_date }}';
            @endif

            @if($free_scheme->proposal_month)
                this.proposal_month ='{{  $free_scheme->proposal_month }}';
            @endif

            @if($free_scheme->amount)
                this.amount ='{{  $free_scheme->amount }}';
            @endif

            let maxId = 0; 
            id='';
            @if($free_scheme['FreeSchemeDetail'])
            @foreach($free_scheme['FreeSchemeDetail'] as $i=>$details)
            this.productDetails.push({
                i: ++maxId,
                id: '{{ $details->id }}',
                product_id: '{{ $details->product_id }}',
                nrv: '{{ $details->nrv }}',
                qty: '{{ $details->qty }}',
                free: '{{ $details->free }}',
                val: '{{ $details->val }}',
            });                    
            @endforeach
            @endif 
        },

        doctor_id:'',
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
       
        property__date : '',
        proposal_month: '',
        dateChange(){     
            this.proposal_month = moment(this.property__date, 'DD/MM/YYYY').format("MMM / YYYY");
        },
        
        zone: '',
        area: '',
        employee_id: '', 
        doctors:'', 
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

        product_id: '',
        nrv: '',
        async productChange() {                    
            this.productDetail.nrv = await (await fetch('/products/'+ this.productDetail.product_id, {
            method: 'GET',
            headers: {
                'Content-type': 'application/json;',
            },
            })).json();
            
        },

        productDetails: [],
        addItem() {
            let maxId = 0;
            if (this.productDetails && this.productDetails.length) {
                maxId = this.productDetails.reduce((max, character) => (character.id > max ? character
                    .id : max), this.productDetails[0].id);
            }
            this.productDetails.push({
                id: maxId + 1,
                product_id: '',
                nrv: '',
                qty: '',
                free: '',
                val: '',
            });
            this.calculateTotal();
        }, 
        
        removeItem(productDetail) {
            this.productDetails = this.productDetails.filter((d) => d.id != productDetail.id);
            this.calculateVal();
            this.calculateTotal();
        },

        calculateVal(){
            let val = 0; 
            if(!isNaN(this.productDetail.qty) && this.productDetail.qty != ''){
                val = this.productDetail.qty * this.productDetail.nrv;          
                this.productDetail.val = val.toFixed(2);
            } 
            this.calculateTotal();
        },

        calculateTotal() {               
            let amount = 0; 
            this.productDetails.forEach(productDetail => {                
                amount = parseFloat(amount) + parseFloat(productDetail.val);
            });                               
            if(!isNaN(amount)){
                this.amount = amount.toFixed(2);
            }     
        },
    }));
});
</script>
</x-layout.default>
