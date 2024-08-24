<x-layout.default>
<style>
    table thead tr th, table tfoot tr th, table tbody tr td {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 0.2rem;
        padding-right: 0.2rem;
    }
</style>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('doctor_business_monitorings.index') }}" class="text-primary hover:underline">CDBM</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Approval</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('doctor_business_monitorings.approval', ['doctor_business_monitoring' => $doctor_business_monitoring->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">CDBM</h5>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>GAF Code :<span style="color: red">*</span></label>
                        <select class="form-input bg-gray-100 dark:bg-gray-700" name="grant_approval_id" x-model="code" disabled>
                            @foreach ($gaf_code as $id => $code)
                                <option value="{{$id}}" {{ $doctor_business_monitoring->grant_approval_id ? ($doctor_business_monitoring->grant_approval_id == $id ? 'Selected' : '' ) : ''}} disabled>{{ $code }}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('code')" class="mt-2" /> 
                    </div>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Marketing Executive')"  :messages="$errors->get('employee_id_2')" x-model="manager" readonly="true"/>                       
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Area Manager')"  :messages="$errors->get('employee_id_2')" x-model="area" readonly="true"/>                       
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Zonal Manager')"  :messages="$errors->get('employee_id_2')" x-model="zone" readonly="true"/>   
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                   
                   <x-text-input class="bg-gray-100 dark:bg-gray-700" x-model="doctor"  :label="__('Doctor Name')"  :messages="$errors->get('doctor_id')" readonly="true"/>
                   <x-text-input name="mpl_no" class="bg-gray-100 dark:bg-gray-700" x-model="mpl_no" value="{{ old('mpl_no') }}" :label="__('MPL NO')"  :messages="$errors->get('mpl_no')" readonly="true"/>
                   <x-text-input name="speciality" class="bg-gray-100 dark:bg-gray-700" x-model="speciality" value="{{ old('speciality') }}" :label="__('Speciality')"  :messages="$errors->get('speciality')" readonly="true"/>
                   <x-text-input name="location" class="bg-gray-100 dark:bg-gray-700" x-model="location" value="{{ old('location') }}" :label="__('Location')"  :messages="$errors->get('location')" readonly="true"/>
               </div>
               <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-text-input name="date" class="bg-gray-100 dark:bg-gray-700" x-model="date" value="{{ old('date') }}" type="date" id="date" :label="__('Date')"  :messages="$errors->get('date')" readonly="true"/>
                    <x-text-input name="month" class="bg-gray-100 dark:bg-gray-700" x-model="month" value="{{ old('month') }}" :label="__('Proposal Month')"  :messages="$errors->get('month')" readonly="true"/>     
                    <x-combo-input name="amount" class="bg-gray-100 dark:bg-gray-700" x-model="amount" value="{{ old('amount') }}" :label="__('Amount')"  :messages="$errors->get('amount')" readonly="true"/>
                    <x-combo-input name="approval_amount" class="bg-gray-100 dark:bg-gray-700" x-model="approval_amount" value="{{ old('approval_amount') }}" :label="__('Approval Amount')"  :messages="$errors->get('approval_amount')" readonly="true"/>
                </div>   
                <!-- <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">                   
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" readonly="true" name="roi" x-model="roi" value="{{ old('roi') }}" @change="calcROI()" :label="__('ROI')"  :messages="$errors->get('roi')"/>
                </div>       -->
            </div>
            <div class="panel table-responsive">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light"> Add Products</h5>
                </div>
                <div>
                    <div class="flex xl:flex-row flex-col gap-2.5">
                        <div class="panel px-0 flex-1 py-1 ltr:xl:mr-6 rtl:xl:ml-6">
                            <div class="mt-8">
                                <template x-if="productDetails">
                                <div class="table-responsive">
                                        <table class="table-hover">
                                            <thead>
                                                <tr>
                                                <th>&nbsp; #</th>
                                                <th>Products</th>
                                                <th>NRV</th>
                                                <th>Avg Business(Units)</th>
                                                <th>Avg Business(Value)</th>
                                                <th>Total Exp Vol (MtoM+6)</th>
                                                <th>Total Exp Val (MtoM+6)</th>
                                                <th>Scheme %</th>
                                                <!--<th>Exp in Vol(M)</th>
                                                <th>Exp in Vol(M+1)</th>
                                                <th>Exp in Vol(M+2)</th>
                                                <th>Exp in Vol(M+3)</th>
                                                <th>Exp in Vol(M+4)</th>
                                                <th>Exp in Vol(M+5)</th>
                                                <th>Exp in Vol(M+6)</th>-->
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
                                                            <input type="hidden" class="form-input min-w-[200px]" x-model="productDetail.id" x-bind:name="`product_details[${productDetail.id}][id]`"/>
                                                            <select class="form-input mt-2 w-100 bg-gray-100 dark:bg-gray-700" name="product_id" x-model="productDetail.product_id" x-bind:name="`product_details[${productDetail.id}][product_id]`"  x-on:change="productChange()" disabled>
                                                                <option>Select Product</option>
                                                                    @foreach ($products as $id => $product)
                                                                        <option value="{{$id}}"
                                                                        {{ $id ? ($id == $doctor_business_monitoring->product_id ? 'selected' : '') : '' }} disabled> {{$product}} </option>
                                                                @endforeach
                                                            </select>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][exp_vol]`"  :messages="$errors->get('exp_vol')" x-model="productDetail.exp_vol" readonly="true"/>
                                                        </td>
                                                        <td>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" readonly="true" x-bind:name="`product_details[${productDetail.id}][nrv]`"  :messages="$errors->get('nrv')" x-model="productDetail.nrv"/>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700"  x-bind:name="`product_details[${productDetail.id}][exp_vol_1]`"  :messages="$errors->get('exp_vol_1')" x-model="productDetail.exp_vol_1" @change="calculateValues()" readonly="true"/>
                                                        </td>
                                                        <td>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][avg_business_units]`"  :messages="$errors->get('avg_business_units')" x-model="productDetail.avg_business_units" @change="calculateAvg()" readonly="true"/>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700"  x-bind:name="`product_details[${productDetail.id}][exp_vol_2]`"  :messages="$errors->get('exp_vol_2')" x-model="productDetail.exp_vol_2" readonly="true"/>
                                                        </td>
                                                        <td>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][avg_business_value]`"  :messages="$errors->get('avg_business_value')" x-model="productDetail.avg_business_value" readonly=true/>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][exp_vol_3]`"  :messages="$errors->get('exp_vol_3')" x-model="productDetail.exp_vol_3" placeholder="M+3" readonly="true"/>
                                                        </td>
                                                        <td>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][total_exp_val]`"  :messages="$errors->get('total_exp_val')" x-model="productDetail.total_exp_val" placeholder="Total Val" @change="calculateValues()" readonly=true/>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][exp_vol_4]`"  :messages="$errors->get('exp_vol_4')" x-model="productDetail.exp_vol_4" placeholder="M+4" readonly="true"/>
                                                        </td>
                                                        <td>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][total_exp_vol]`"  :messages="$errors->get('total_exp_vol')" x-model="productDetail.total_exp_vol" placeholder="Total Vol" readonly=true/>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][exp_vol_5]`"  :messages="$errors->get('exp_vol_5')" x-model="productDetail.exp_vol_5" placeholder="M+5" readonly="true"/>
                                                        </td>
                                                        <td>
                                                            <select class="form-input mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][scheme]`" x-model="productDetail.scheme" @change="calculateTotal()" disabled>
                                                                <option  value="" disabled> Scheme% </option>
                                                                @for ($i = 0; $i <= 100; $i++)
                                                                    <option value="{{ $i }}" {{ $i ? ($i == $doctor_business_monitoring->scheme ? 'selected' : '') : '' }} disabled> {{ $i }}% </option>
                                                                @endfor
                                                            </select>
                                                            <x-text-input class="mt-2 bg-gray-100 dark:bg-gray-700" x-bind:name="`product_details[${productDetail.id}][exp_vol_6]`"  :messages="$errors->get('exp_vol_6')" x-model="productDetail.exp_vol_6" @change="calculateValues()" placeholder="M+6" readonly="true"/>
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
                                                    <th colspan="7" style="text-align:right;">Total of Total Expected Value: </th>
                                                    <td>               
                                                        <x-text-input class="form-input bg-gray-100 dark:bg-gray-700 mt-2" x-model="total" readonly="true" :messages="$errors->get('total_expected_value')" value="{{ $doctor_business_monitoring->total_expected_value }}" name="total_expected_value" readonly=true/>
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <th colspan="7" style="text-align:right">Total of Avg Business Value:</th>
                                                    <td><x-text-input class="form-input  bg-gray-100 dark:bg-gray-700 mt-2" :messages="$errors->get('total_business_value')" value="{{ $doctor_business_monitoring->total_business_value }}"  x-model="avg_total" name="total_business_value" readonly=true/></td>
                                                </tr> 
                                                <tr>
                                                    <th colspan="7" style="text-align:right">ROI: </th>
                                                    <td>
                                                        <x-text-input class="bg-gray-100 dark:bg-gray-700 mt-2" readonly="true" name="roi" x-model="roi" value="{{ old('roi') }}" @change="calcROI()" :messages="$errors->get('roi')"/>
                                                    </td>
                                                </tr>
                                            </tfoot>                             
                                        </table>
                                    </div>
                                </template>                                                
                            </div>                            
                        </div>                    
                    </div>
                </div>                
            </div>  
            <div class="flex justify-end mt-4">
                <x-success-button>
                        {{ __('Approval') }}
                </x-success-button>
                &nbsp;&nbsp;
                <x-cancel-button :link="route('doctor_business_monitorings.index')">
                    {{ __('Cancel') }}
                </x-cancel-button>
            </div>
        </form> 
    </div>
</div>
<script>
document.addEventListener("alpine:init", () => {
    Alpine.data('data', () => ({
        product_id: '',
        nrv: '',
        productDetails: [],
        code: '',
        employee_id_1: '',
        employee_id_2: '',
        employee_id_3: '',
        doctor: '',
        mpl_no: '',
        speciality: '',
        location: '',
        date: '',
        month: '',
        amount: '',
        data: '',
        area: '',
        zone: '',
        manager: '',
        docData: '',
        roi: '',
        init() {
            this.avg_business_value = 0;  
            this.total_exp_vol = 0;
            this.total_exp_val = 0;
            this.total = 0;
            this.avg_total = 0;
            this.total_roi = 0;
            this.approval_amount = 0;
            var options = {
                searchable: true
            };
            
            // NiceSelect.bind(document.getElementById("code"), options);

            flatpickr(document.getElementById('date'), {
                dateFormat: 'd/m/Y',
            });
            
            @if($doctor_business_monitoring->grant_approval_id)
                
                this.code = {{  $doctor_business_monitoring->grant_approval_id }};
                this.codeChange();
            @endif

            @if($doctor_business_monitoring->total_business_value)                
                this.avg_total = {{  $doctor_business_monitoring->total_business_value }};
            @endif

            @if($doctor_business_monitoring->total_expected_value)                
                this.total = {{  $doctor_business_monitoring->total_expected_value }};
            @endif

            @if($doctor_business_monitoring->roi)
                this.roi = {{  $doctor_business_monitoring->roi }};
            @endif

        
            let maxId = 0; 
            id='';
            @if($doctor_business_monitoring['ProductDetails'])
            @foreach($doctor_business_monitoring['ProductDetails'] as $i=>$details)
            this.productDetails.push({
                i: ++maxId,
                id: '{{ $details->id }}',
                product_id: '{{ $details->product_id }}',
                nrv: '{{ $details->nrv }}',
                avg_business_units: '{{ $details->avg_business_units }}',
                avg_business_value: '{{ $details->avg_business_value }}',
                exp_vol: '{{ $details->exp_vol }}',
                exp_vol_1: '{{ $details->exp_vol_1 }}',
                exp_vol_2: '{{ $details->exp_vol_2 }}',
                exp_vol_3: '{{ $details->exp_vol_3 }}',
                exp_vol_4: '{{ $details->exp_vol_4 }}',
                exp_vol_5: '{{ $details->exp_vol_5 }}',
                exp_vol_6: '{{ $details->exp_vol_6 }}',
                total_exp_vol: '{{ $details->total_exp_vol }}',
                total_exp_val: '{{ $details->total_exp_val }}',
                scheme: '{{ $details->scheme }}',
            });   
                             
            @endforeach
            @endif    
                  
        },

        async productChange() {               
            this.productDetail.nrv = await (await fetch('/products/'+ this.productDetail.product_id, {
            method: 'GET',
            headers: {
                'Content-type': 'application/json;',
            },
            })).json();
            this.calculateAvg();
        },
           
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
            });
            this.calculateValues();
            this.calculateTotal();           
        }, 
                        
        removeItem(productDetail) {
            this.productDetails = this.productDetails.filter((d) => d.id != productDetail.id);
            this.calculateValues();
            this.calculateTotal();
            this.calculateAvg();
            this.calcROI();
        },
        
        async codeChange(){
            this.data = await (await fetch('/grant_approvals/'+ this.code, {
                method: 'GET',
                headers: {
                    'Content-type': 'application/json;',
                },
            })).json();
            console.log(this.data.doctor)
            this.manager = this.data.manager.name;
            this.area = this.data.manager.area_manager.name;
            this.zone = this.data.manager.zonal_manager.name;
            this.doctor = this.data.doctor.doctor_name;
            this.mpl_no = this.data.doctor.mpl_no;
            this.location = this.data.doctor.type;
            this.speciality = this.data.doctor.speciality;
            this.date = this.data.date_of_issue;
            this.month = this.data.proposal_month;
            this.amount = this.data.proposal_amount;
            this.approval_amount = this.data.approval_amount;
            this.calcROI();
        },

        calculateAvg(){
            let avg = 0; 

            if(!isNaN(this.productDetail.avg_business_units) && this.productDetail.avg_business_units != ''){
                avg = this.productDetail.avg_business_units * this.productDetail.nrv;          
                this.productDetail.avg_business_value = avg.toFixed(2);
            }   

        },
        calculateValues() {
          

            this.productDetails.forEach(productDetail => {     
                let avg = 0; 
            let total_exp_vol = 0;
            let total_val = 0;           
                
                    
                if(!isNaN(productDetail.exp_vol) && productDetail.exp_vol != ''){
                    total_exp_vol += parseFloat(productDetail.exp_vol);
                }  

                if(!isNaN(productDetail.exp_vol_1) && productDetail.exp_vol_1 != ''){
                    total_exp_vol += parseFloat(productDetail.exp_vol_1);
                }  

                if(!isNaN(productDetail.exp_vol_2) && productDetail.exp_vol_2 != ''){
                    total_exp_vol += parseFloat(productDetail.exp_vol_2);
                }  

                if(!isNaN(productDetail.exp_vol_3) && productDetail.exp_vol_3 != ''){
                    total_exp_vol += parseFloat(productDetail.exp_vol_3);
                }  

                if(!isNaN(productDetail.exp_vol_4) && productDetail.exp_vol_4 != ''){
                    total_exp_vol += parseFloat(productDetail.exp_vol_4);
                }  

                if(!isNaN(productDetail.exp_vol_5) && productDetail.exp_vol_5 != ''){
                    total_exp_vol += parseFloat(productDetail.exp_vol_5);
                }  

                if(!isNaN(productDetail.exp_vol_6) && productDetail.exp_vol_6 != ''){
                    total_exp_vol += parseFloat(productDetail.exp_vol_6);
                }                  
                productDetail.total_exp_vol = total_exp_vol.toFixed(2);

                total_val = productDetail.total_exp_vol * productDetail.nrv;          
                productDetail.total_exp_val = total_val.toFixed(2);
            }); 
            this.calculateTotal();
        },
        calculateTotal() {
            let total = 0;  
            this.productDetails.forEach(productDetail => {
                total = parseFloat(total) + parseFloat(productDetail.total_exp_val);
            });                     
            if(!isNaN(total)){
                this.total = total.toFixed(2);
            }        

            let avg_total = 0;
            this.productDetails.forEach(productDetail => {
                avg_total = parseFloat(avg_total) + parseFloat(productDetail.avg_business_value);
            });                     
            if(!isNaN(avg_total)){
                this.avg_total = avg_total.toFixed(2);
            }                   
            this.calcROI();
        },
        calcROI() {
            let roi = 0;
            if(!isNaN(this.total) && this.total != '' && !isNaN(this.amount) && this.amount != ''){
                this.roi = (this.total / this.amount).toFixed(2); 
            }   
          
        },
    }));
});

</script>
</x-layout.default>
