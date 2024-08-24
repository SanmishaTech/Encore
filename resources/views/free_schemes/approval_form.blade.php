<x-layout.default>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route('free_schemes.index') }}" class="text-primary hover:underline">Free Scheme Approval</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Edit</span>
            </li>
        </ul>
        <div class="pt-5" x-data="data">        
            <form class="space-y-5" action="{{ route('free_schemes.approval', ['free_scheme' => $free_scheme->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Free Scheme Approval</h5>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">  
                        @foreach ($employees as $id => $employee)
                            @if ($id == $free_scheme->employee_id)
                                <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Marketing Executive')" :messages="$errors->get('employee_id_1')" value="{{ $employee }}" readonly/>
                            @endif
                        @endforeach
                        {{--  --}}
                        <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Area Manager')"  :messages="$errors->get('employee_id_2')" x-model="area" readonly="true"/>                       
                        <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Zonal Manager')"  :messages="$errors->get('employee_id_2')" x-model="zone" readonly="true"/>                      
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                        <div>
                                @foreach ($doctors as $id=>$doctor)     
                                @if($free_scheme->doctor_id == $id)
                                <x-text-input class="bg-gray-100 dark:bg-gray-700" value="{{$doctor}}" :label="__('Doctor')"  :messages="$errors->get('doctor_id')" readonly="true"/>     
                                @endif                         
                            @endforeach  
                        </div>
                        <x-text-input class="bg-gray-100 dark:bg-gray-700" x-model="mpl_no" :label="__('MPL No')"  :messages="$errors->get('mpl_no')" readonly="true"/>
                        <x-text-input class="bg-gray-100 dark:bg-gray-700"  x-model="speciality"   :label="__('Speciality')"  :messages="$errors->get('speciality')" readonly="true"/>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                        <div>
                            <x-text-input class="bg-gray-100 dark:bg-gray-700" x-model="location" :label="__('Location')"  :messages="$errors->get('location')" readonly="true"/>
                        </div>
                        <x-text-input class="bg-gray-100 dark:bg-gray-700" name="proposal_date" id="proposal_date" value="{{ old('proposal_date', $free_scheme->proposal_date) }}" x-model="proposal_date" x-on:change.debounce="dateChange()" :label="__('Proposal Date')"  :messages="$errors->get('proposal_date')" readonly="true"/>
                        <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Proposal Month')" x-model="proposal_month" name="proposal_month" :messages="$errors->get('proposal_month')" readonly="true"/> 
                            <div>
                                <label>Free Scheme Type: <span class=text-danger>*</span></label>
                                <select class="form-input" name="free_scheme_type" disabled>
                                    <option value="" disabled>Select Type</option>
                                    <option value='Reimburse'  @if ($free_scheme->free_scheme_type =='Reimburse') {{ 'Selected' }} @endif>Reimburse</option>
                                    <option value='Regular'  @if ($free_scheme->free_scheme_type =='Regular') {{ 'Selected' }} @endif>Regular</option>    
                                </select>
                            <x-input-error :messages="$errors->get('free_scheme_type')" class="mt-2" /> 
                            </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>              
                      @foreach ($stockists as $id=>$stockist)     
                        @if($free_scheme->stockist_id == $id)
                        <x-text-input class="bg-gray-100 dark:bg-gray-700" value="{{$stockist}}" :label="__('Stockist')"  :messages="$errors->get('stockist_id')" readonly="true"/>     
                        @endif 
                        @endforeach  
                    </div>
                    <div>
                    @foreach ($chemists as $id=>$chemist)     
                    @if($free_scheme->chemist_id == $id)
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" value="{{$chemist}}" :label="__('Chemist')"  :messages="$errors->get('chemist_id')" readonly="true"/>     
                    @endif 
                    @endforeach  
                    </div>       
                    {{-- <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4"> --}}
                        {{-- <div>
                            <label>Open Scheme:</label>
                            <select class="form-input" name="open_scheme">
                                <option >Select Open scheme</option>
                                <option value='Yes' @if ($free_scheme->open_scheme =='Yes') {{ 'Selected' }} @endif>Yes</option>
                                <option value='No' @if ($free_scheme->open_scheme =='No') {{ 'Selected' }} @endif>No</option>                           
                            </select>
                        </div> --}}
                        <div>
                            <label>Open Scheme:</label>
                            <select class="form-input" name="open_scheme" disabled>
                                <option>Select Open scheme</option>
                                <option value='Yes' @if ($free_scheme->open_scheme =='Yes') {{ 'selected' }} @endif>Yes</option>
                                <option value='No' @if ($free_scheme->open_scheme =='No') {{ 'selected' }} @endif>No</option>                           
                            </select>
                        </div>
                        <div>
                            <label>Scheme:</label>
                            <select class="form-input" name="scheme" disabled>
                                <option value="" disabled>Select Scheme% </option>
                                @for($i = 0; $i <= 100; $i++)
                                    <option value="{{ $i }}" {{ $i ? ($i == $free_scheme->scheme ? 'selected' : '') : '' }}> {{ $i }}%</option>
                                @endfor
                            </select>
                        </div>    
                        <div>
                            <label>CRM Done:</label>
                            <select class="form-input" name="crm_done" disabled>
                                <option >Select CRM Done</option>
                                <option value='Yes' @if ($free_scheme->crm_done =='Yes') {{ 'Selected' }} @endif>Yes</option>
                                <option value='No' @if ($free_scheme->crm_done =='No') {{ 'Selected' }} @endif>No</option>                           
                            </select>
                        </div>
                        <div>
                            <label>Dr Own Counter:</label>
                            <select class="form-input" name="dr_own_counter" disabled>
                                <option >Select Counter</option>
                                <option value='Yes' @if ($free_scheme->dr_own_counter =='Yes') {{ 'Selected' }} @endif>Yes</option>
                                <option value='No' @if ($free_scheme->dr_own_counter =='No') {{ 'Selected' }} @endif>No</option>                           
                            </select>
                        </div>           
                    {{-- </div>         --}}
                </div>
                <div class="panel table-responsive">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light"> Add Products</h5>
                    </div>
                    <div>
                        <div class="flex xl:flex-row flex-col gap-1">
                            <div class="panel px-0 flex-1  ltr:xl:mr-6 rtl:xl:ml-6">
                                <div class="mt-8">
                                    <template x-if="freeSchemeDetails">
                                        <div class="table-responsive">
                                            <table class="table-hover">
                                                <thead>
                                                    <tr width="100%">
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
                                                                {{-- <button type="button" @click="removeItem(freeSchemeDetail)" disabled>
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
                                                                </button> --}}
                                                            </td>
                                                            <td>
                                                                <input type="hidden" class="form-input min-w-[230px]" x-model="freeSchemeDetail.id" x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][id]`" disabled/>
                                                                <select class="form-input" name="product_id" x-model="freeSchemeDetail.product_id" x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][product_id]`"  x-on:change="productChange()" disabled>
                                                                    <option>Select Product</option>
                                                                        @foreach ($products as $id => $product)
                                                                            <option value="{{$id}}"
                                                                            {{ $id ? ($id == $free_scheme->product_id ? 'selected' : '') : '' }}> {{$product}} </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <x-text-input   class="bg-gray-100 dark:bg-gray-700" readonly="true" x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][nrv]`"  :messages="$errors->get('nrv')" x-model="freeSchemeDetail.nrv" disabled/>
                                                            </td>   
                                                            <td>
                                                                <x-text-input x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][qty]`"  :messages="$errors->get('qty')" x-model="freeSchemeDetail.qty" @change="calculateVal()" disabled/>
                                                            </td>  
                                                            <td>
                                                                <x-text-input x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][free_qty]`"  :messages="$errors->get('free_qty')" x-model="freeSchemeDetail.free_qty" disabled/>
                                                            </td>                                                 
                                                            <td>                                                       
                                                                <select class="form-input" style="width:100px;" x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][free]`" x-model="freeSchemeDetail.free"  @change="calculateVal()" disabled>
                                                                    <option  value="" disabled> Free </option>
                                                                    @for ($i = 0; $i <= 100; $i++)
                                                                        <option value="{{ $i }}" {{ $i ? ($i == $free_scheme->free ? 'selected' : '') : '' }}> {{ $i }}% </option>
                                                                    @endfor
                                                                </select>
                                                            </td>                                                    
                                                            <td>
                                                                <x-text-input  x-bind:name="`free_scheme_details[${freeSchemeDetail.id}][val]`"  :messages="$errors->get('val')" x-model="freeSchemeDetail.val" @change="calculateTotal()" disabled/>
                                                            </td>                                                    
                                                        </tr>
                                                    </template>
                                                    <tr>
                                                        <td>
                                                            {{-- <button type="button" class="btn btn-info" @click.prevent="addItem()" disabled>+ </button> --}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot  style="background-color: #FFFFF;">
                                                    <tr>
                                                        <th colspan="6" style="text-align:right;">Total Amount: </th>
                                                        <td>               
                                                            <x-text-input class="form-input bg-gray-100 dark:bg-gray-700" x-model="amount" readonly="true" :messages="$errors->get('amount')" value="{{ old('amount', $free_scheme->amount) }}" name="amount" disabled/>
                                                        </td>
                                                    </tr>                                           
                                                </tfoot>                                   
                                            </table>
                                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                                                <div style="flex: 1;">
                                                    <p style="font-size: 16px; font-weight: bold; color: #333; padding: 10px;">
                                                        Proof Of Order:
                                                    </p>
                                                    <input type="file" name="proof_of_order" id="proof_of_order" style="margin-top: 5px; margin-left:10px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; width: 100%;" disabled>
                                                </div>
                                                <div style="flex: 1; margin-left: 10px;">
                                                    <p style="font-size: 16px; font-weight: bold; color: #333; padding: 10px;">
                                                        Proof Of Delivery:
                                                    </p>
                                                    <input type="file" name="proof_of_delivery" id="proof_of_delivery" style="margin-top: 5px; margin-left:10px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; width: 94%;" disabled>
                                                </div>
                                            </div>
                                            <div style="display: flex; justify-content: space-around;">
                                                <div>
                                                    @if ($free_scheme->proof_of_order)
                                                        <a href="{{ asset('public/proof_of_order/' . $free_scheme->proof_of_order) }}" target="_blank" style="text-decoration: none; color: #007bff; font-weight: bold;">
                                                            View Proof of Order
                                                        </a>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if ($free_scheme->proof_of_delivery)
                                                        <a href="{{ asset('public/proof_of_delivery/' . $free_scheme->proof_of_delivery) }}" target="_blank" style="text-decoration: none; color: #007bff; font-weight: bold;">
                                                            View Proof of Delivery
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </template>
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
                @if($free_scheme['freeSchemeDetail'])
                @foreach($free_scheme['freeSchemeDetail'] as $i=>$details)
                this.freeSchemeDetails.push({
                    i: ++maxId,
                    id: '{{ $details->id }}',
                    product_id: '{{ $details->product_id }}',
                    nrv: '{{ $details->nrv }}',
                    qty: '{{ $details->qty }}',
                    free_qty: '{{ $details->free_qty }}',
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
                    free: '',
                    val: '',
                });
                this.calculateTotal();
            }, 
            
            removeItem(freeSchemeDetail) {
                this.freeSchemeDetails = this.freeSchemeDetails.filter((d) => d.id != freeSchemeDetail.id);
                this.calculateVal();
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
    