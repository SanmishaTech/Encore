<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('doctor_business_monitorings.index') }}" class="text-primary hover:underline">DBM</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('doctor_business_monitorings.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add DBM</h5>
                </div>               
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>GAF Code :<span style="color: red">*</span></label>
                        <select class="form-input" name="code" x-model="code" @change="codeChange()">
                            <option>Select Code</option>
                            @foreach ($gaf_code as $id => $code)
                                <option value="{{$id}}">{{ $code }}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('code')" class="mt-2" /> 
                    </div> 
                    <div>
                        <label>Managing Executive :</label>
                        <select class="form-input bg-gray-100 dark:bg-gray-700" name="employee_id_1" readonly="true"  x-model="employee_id_1">
                            <option>Select Managing Executive</option>
                            <option key="manager.id" :value="manager.id" x-text="manager.name" ></option>
                        </select>
                    </div>
                    <div>
                        <label>Area Manager :</label>
                        <select class="form-input bg-gray-100 dark:bg-gray-700" name="employee_id_2" readonly="true"  x-model="employee_id_2">
                            <option>Select Area Manager</option>
                            <option key="area.id" :value="area.id" x-text="area.name" ></option>
                        </select>
                    </div>
                    <div>
                        <label>Zonal Manager :</label>
                        <select class="form-input bg-gray-100 dark:bg-gray-700" name="employee_id_3" readonly="true"  x-model="employee_id_3">
                            <option>Select Zonal Manager</option>
                            <option key="zone.id" :value="zone.id" x-text="zone.name" ></option>
                        </select> 
                    </div>                    
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Doctor:</label>
                        <select class="form-input bg-gray-100 dark:bg-gray-700" name="doctor_id" readonly="true"  x-model="doctor_id">
                            <option>Select Doctor</option>
                            <option key="docData.id" :value="docData.id" x-text="docData.doctor_name" ></option>
                        </select> 
                    </div>  
                    <x-text-input name="mpl_no" class="bg-gray-100 dark:bg-gray-700" x-model="mpl_no" value="{{ old('mpl_no') }}" :label="__('MPL NO')"  :messages="$errors->get('mpl_no')" readonly="true"/>
                    <x-text-input name="speciality" class="bg-gray-100 dark:bg-gray-700" x-model="speciality" value="{{ old('speciality') }}" :label="__('Speciality')"  :messages="$errors->get('speciality')" readonly="true"/>
                    <x-text-input name="location" class="bg-gray-100 dark:bg-gray-700" x-model="location" value="{{ old('location') }}" :label="__('Location')"  :messages="$errors->get('location')" readonly="true"/>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-text-input name="date" class="bg-gray-100 dark:bg-gray-700" x-model="date" value="{{ old('date') }}" type="date" id="date" :label="__('Date')"  :messages="$errors->get('date')" readonly="true"/>
                    <x-text-input name="month" class="bg-gray-100 dark:bg-gray-700" x-model="month" value="{{ old('month') }}" :label="__('Proposal Month')"  :messages="$errors->get('month')" readonly="true"/>     
                    <x-combo-input name="amount" class="bg-gray-100 dark:bg-gray-700" x-model="amount" value="{{ old('amount') }}" :label="__('Amount')"  :messages="$errors->get('amount')" readonly="true"/>
                    <x-text-input name="roi" value="{{ old('roi') }}" :label="__('ROI')"  :messages="$errors->get('roi')"/>
                </div>                                
            </div>            
            <div class="panel table-responsive">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light"> Add Products</h5>
                </div>
                <div class="flex xl:flex-row flex-col gap-2.5">
                    <div class="panel px-0 flex-1 py-1 ltr:xl:mr-6 rtl:xl:ml-6">
                        <div class="mt-8">
                            <template x-if="productDetails">
                                <div class="table-responsive">
                                    <table class="table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%">&nbsp; #</th>
                                                <th>Products</th>
                                                <th>NRV</th>
                                                <th>Avg Business(Units)</th>
                                                <th>Avg Business(Value)</th>
                                                <th>Exp in Vol(M)</th>
                                                <th>Exp in Vol(M+1)</th>
                                                <th>Exp in Vol(M+2)</th>
                                                <th>Exp in Vol(M+3)</th>
                                                <th>Exp in Vol(M+4)</th>
                                                <th>Exp in Vol(M+5)</th>
                                                <th>Exp in Vol(M+6)</th>
                                                <th>Total Exp Vol (MtoM+6)</th>
                                                <th>Total Exp Val (MtoM+6)</th>
                                                <th>Scheme %</th>
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
                                                        <select class="form-input" x-model="productDetail.product_id" x-bind:name="`product_details[${productDetail.id}][product_id]`"  x-on:change="productChange()">
                                                            <option>Select Product</option>
                                                                @foreach ($products as $id => $product)
                                                                    <option value="{{$id}}"> {{$product}} </option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" /> 
                                                    </td>
                                                    <td>
                                                        <x-text-input class="bg-gray-100 dark:bg-gray-700" readonly="true" x-bind:name="`product_details[${productDetail.id}][nrv]`"  :messages="$errors->get('nrv')" x-model="productDetail.nrv"/>
                                                    </td>                                                    
                                                    <td>
                                                        <x-text-input x-bind:name="`product_details[${productDetail.id}][avg_business_units]`"  :messages="$errors->get('avg_business_units')" x-model="productDetail.avg_business_units"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][avg_business_value]`"  :messages="$errors->get('avg_business_value')" x-model="productDetail.avg_business_value"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][exp_vol]`"  :messages="$errors->get('exp_vol')" x-model="productDetail.exp_vol"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][exp_vol_1]`"  :messages="$errors->get('exp_vol_1')" x-model="productDetail.exp_vol_1"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][exp_vol_2]`"  :messages="$errors->get('exp_vol_2')" x-model="productDetail.exp_vol_2"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][exp_vol_3]`"  :messages="$errors->get('exp_vol_3')" x-model="productDetail.exp_vol_3"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][exp_vol_4]`"  :messages="$errors->get('exp_vol_4')" x-model="productDetail.exp_vol_4"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][exp_vol_5]`"  :messages="$errors->get('exp_vol_5')" x-model="productDetail.exp_vol_5"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][exp_vol_6]`"  :messages="$errors->get('exp_vol_6')" x-model="productDetail.exp_vol_6"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][total_exp_vol]`"  :messages="$errors->get('total_exp_vol')" x-model="productDetail.total_exp_vol"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][total_exp_val]`"  :messages="$errors->get('total_exp_val')" x-model="productDetail.total_exp_val"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][scheme]`"  :messages="$errors->get('scheme')" x-model="productDetail.scheme"/>
                                                    </td>
                                                </tr>
                                            </template>
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn btn-info" @click.prevent="addItem()">+ </button>
                                                </td>
                                            </tr>
                                        </tbody>                           
                                    </table>
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
        init() {
            flatpickr(document.getElementById('date'), {
                dateFormat: 'd/m/Y',
            });
        },   

        code: '',
        employee_id_1: '',
        employee_id_2: '',
        employee_id_3: '',
        doctor_id: '',
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
        async codeChange(){
            this.data = await (await fetch('/grant_approvals/'+ this.code, {
                
                method: 'GET',
                headers: {
                    'Content-type': 'application/json;',
                },
                })).json();
            this.manager = this.data.manager;
            this.area = this.data.area_manager;
            this.zone = this.data.zonal_manager;
            this.docData = this.data.doctor;
            this.mpl_no = this.data.mpl_no;
            this.location = this.data.location;
            this.speciality = this.data.speciality;
            this.date = this.data.date;
            this.month = this.data.proposal_month;
            this.amount = this.data.amount;
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
                avg_business_units: '',
                avg_business_value: '',
                exp_vol: '',
                exp_vol_1: '',
                exp_vol_2: '',
                exp_vol_3: '',
                exp_vol_4: '',
                exp_vol_5: '',
                exp_vol_6: '',
                total_exp_vol: '',
                total_exp_val: '',
                scheme: '',
            });
        }, 
        
        removeItem(productDetail) {
            this.productDetails = this.productDetails.filter((d) => d.id != productDetail.id);
            this.calculateTotal();
        },
    }));
});
</script> 
</x-layout.default>
