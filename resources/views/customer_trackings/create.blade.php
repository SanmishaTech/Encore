<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('customer_trackings.index') }}" class="text-primary hover:underline">Customer Tracking</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('customer_trackings.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Customer Tracking</h5>
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
                    <x-text-input name="proposal_date" id="proposal_date" value="{{ old('proposal_date') }}" :label="__('Date')" x-model="proposal_date" x-on:change.debounce="dateChange()" :messages="$errors->get('proposal_date')"/>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Proposal Month')" x-model="proposal_month" name="proposal_month" :messages="$errors->get('proposal_month')" readonly="true"/> 
                    <x-text-input name="primary" value="{{ old('primary') }}" :label="__('Primary')" :messages="$errors->get('primary')"/>   
                    <x-text-input name="secondary" value="{{ old('secondary') }}" :label="__('secondary')" :messages="$errors->get('secondary')"/>       
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
                                    <table class="table-hover" width="100%">
                                        <thead>
                                            <tr  width="100%">
                                                <th>&nbsp; #</th>
                                                <th>Doctor</th>
                                                <th>speciality</th>
                                                <th>location</th>
                                                <th>Products</th>
                                                <th>NRV</th>
                                                <th>Average Quantity</th>
                                                <th>Average Value</th>
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
                                                        <select required class="form-input" x-model="productDetail.doctor_id" x-bind:name="`product_details[${productDetail.id}][doctor_id]`"  x-on:change="doctorChange()">
                                                            <option value="" disabled selected>Select Doctor</option>
                                                                @foreach ($doctors as $id => $doctor)
                                                                    <option value="{{$id}}"> {{$doctor}} </option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" /> 
                                                        <x-text-input class="mt-2 " x-bind:name="`product_details[${productDetail.id}][m_1]`"  :messages="$errors->get('m_1')" x-model="productDetail.m_1"  @change="calculateValues()" placeholder="M+1" required/>   

                                                    </td>
                                                    <td>
                                                        <x-text-input class="bg-gray-100 dark:bg-gray-700" readonly="true" x-bind:name="`product_details[${productDetail.id}][speciality]`" :messages="$errors->get('speciality')" x-model="productDetail.speciality"/>
                                                         <x-text-input class="mt-2 " x-bind:name="`product_details[${productDetail.id}][m_2]`"  :messages="$errors->get('m_2')" x-model="productDetail.m_2"  @change="calculateValues()" placeholder="M+2"/>   

                                                    </td>
                                                    <td>
                                                        <x-text-input class="bg-gray-100 dark:bg-gray-700" readonly="true" x-bind:name="`product_details[${productDetail.id}][location]`" :messages="$errors->get('location')" x-model="productDetail.location"/>
                                                         <x-text-input class="mt-2 " x-bind:name="`product_details[${productDetail.id}][m_3]`"  :messages="$errors->get('m_3')" x-model="productDetail.m_3"  @change="calculateValues()" placeholder="M+3"/>   

                                                    </td>
                                                    <td>
                                                        <select required class="form-input" x-model="productDetail.product_id" x-bind:name="`product_details[${productDetail.id}][product_id]`"  x-on:change="productChange()">
                                                            <option value="" disabled selected>Select Product</option>
                                                                @foreach ($products as $id => $product)
                                                                    <option value="{{$id}}"> {{$product}} </option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                                                            <x-text-input class="mt-2 " x-bind:name="`product_details[${productDetail.id}][m_4]`"  :messages="$errors->get('m_4')" x-model="productDetail.m_4"  @change="calculateValues()" placeholder="M+4"/>   
                                                    </td>
                                                  
                                                    <td>
                                                        <x-text-input class="bg-gray-100 dark:bg-gray-700" style="margin-bottom: 45px;" readonly="true" x-bind:name="`product_details[${productDetail.id}][nrv]`"  :messages="$errors->get('nrv')" x-model="productDetail.nrv"/>
                                                        </td>
                                                    <td>                                                                                                                                             
                                                        <x-text-input x-bind:name="`product_details[${productDetail.id}][qty]`" style="margin-bottom: 45px;" class="bg-gray-100 dark:bg-gray-700"  :messages="$errors->get('qty')" x-model="productDetail.qty" readonly="true" @change="calculateVal()"/>
                                                        </td>
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][val]`" style="margin-bottom: 45px;" :messages="$errors->get('val')" class="bg-gray-100 dark:bg-gray-700" x-model="productDetail.val" readonly="true" @change="calculateTotal()"/>
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
                                                <th colspan="7" style="text-align:right;">Total Amount: </th>
                                                <td>               
                                                    <x-text-input class="form-input bg-gray-100 dark:bg-gray-700"  readonly="true" :messages="$errors->get('amount')"  name="amount" x-model="amount"/>
                                                </td>
                                            </tr>
                                        </tfoot>                
                                    </table>
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

        doctor_id: '',
        doctorData: '',
        location: '',
        speciality: '',
        async doctorChange() {
            this.doctorData = await (await fetch('/doctors/'+ this.productDetail.doctor_id, {                
            method: 'GET',
            headers: {
                'Content-type': 'application/json;',
            },
            })).json();
            this.productDetail.location = this.doctorData.type;
            this.productDetail.speciality = this.doctorData.speciality;
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
                doctor_id: '',
                speciality: '',
                location: '', 
                product_id: '',
                nrv: '',
                qty: '',
                val: '',
                m_1: '',
                m_2: '',
                m_3: '',
                m_4: '',
            });
            this.calculateTotal();
        }, 
        
        removeItem(productDetail) {
            this.productDetails = this.productDetails.filter((d) => d.id != productDetail.id);
            this.calculateVal();
            this.calculateTotal();
            this.calculateValues();
        },

        calculateVal(){
            let val = 0; 
            let avg = 0;
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


        // my
        calculateValues() {
          this.productDetails.forEach(productDetail => {     
              let avg = 0; 
          let total_m_val = 0;
        //   let total_val = 0;           
              
                  
              if(!isNaN(productDetail.m_1) && productDetail.m_1 != ''){
                total_m_val += parseFloat(productDetail.m_1);
              } 
              
              if(!isNaN(productDetail.m_2) && productDetail.m_2 != ''){
                total_m_val += parseFloat(productDetail.m_2);
              } 

              if(!isNaN(productDetail.m_3) && productDetail.m_3 != ''){
                total_m_val += parseFloat(productDetail.m_3);
              } 

              if(!isNaN(productDetail.m_4) && productDetail.m_4 != ''){
                total_m_val += parseFloat(productDetail.m_4);
              } 
                   avg = total_m_val / 4;
              productDetail.qty = avg.toFixed(2);

          }); 
          this.calculateVal();
          this.calculateTotal();
      }


    }));
});
</script>
</x-layout.default>
