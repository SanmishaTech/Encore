<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('customer_trackings.index') }}" class="text-primary hover:underline">Customer Tracking</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('customer_trackings.update', ['customer_tracking' => $customer_tracking->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Customer Tracking</h5>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">  
                    <div>
                        <label>Marketing Executive :</label>
                        <select class="form-input" name="employee_id" x-model="employee_id" @change="mehqChange()">
                            <option>Select Marketing Executive</option>
                            @foreach ($employees as $id=>$employee)                                
                                <option value="{{$id}}" {{ $id ? ($id == $customer_tracking->employee_id ? 'Selected' : '') : '' }}>{{$employee}}</option>                                
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_1')" class="mt-2" />
                    </div>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Area Manager')"  :messages="$errors->get('employee_id_2')" x-model="area" readonly="true"/>                       
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Zonal Manager')"  :messages="$errors->get('employee_id_2')" x-model="zone" readonly="true"/>                      
                </div>
                
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-text-input name="proposal_date" id="proposal_date" value="{{ old('proposal_date', $customer_tracking->proposal_date) }}"  x-model="proposal_date" x-on:change.debounce="dateChange()" :label="__('Proposal Date')"  :messages="$errors->get('proposal_date')"/>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Proposal Month')" x-model="proposal_month" name="proposal_month" :messages="$errors->get('proposal_month')" readonly="true"/> 
                    <x-text-input name="primary" value="{{ old('primary', $customer_tracking->primary) }}" :label="__('Primary')" :messages="$errors->get('primary')"/>   
                    <x-text-input name="secondary" value="{{ old('secondary', $customer_tracking->secondary) }}" :label="__('secondary')" :messages="$errors->get('secondary')"/>
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
                                                        <input type="hidden" class="form-input min-w-[230px]" x-model="productDetail.id" x-bind:name="`product_details[${productDetail.id}][id]`"/>
                                                        <select class="form-input" name="doctor_id" x-model="productDetail.doctor_id" x-bind:name="`product_details[${productDetail.id}][doctor_id]`"  x-on:change="doctorChange()" required>
                                                            <option value="" disabled selected >Select Doctor</option>
                                                                @foreach ($doctors as $id => $doctor)
                                                                    <option value="{{$id}}"
                                                                    {{ $id ? ($id == $customer_tracking->doctor_id ? 'selected' : '') : '' }}> {{$doctor}} </option>
                                                            @endforeach
                                                        </select>
                                                        <x-text-input class="mt-2 " x-bind:name="`product_details[${productDetail.id}][m_1]`"  :messages="$errors->get('m_1')" x-model="productDetail.m_1"  @change="calculateValues()" placeholder="M1" required/>   

                                                    </td>
                                                    <td>
                                                        <x-text-input class="bg-gray-100 dark:bg-gray-700" readonly="true" x-bind:name="`product_details[${productDetail.id}][speciality]`"  :messages="$errors->get('speciality')" x-model="productDetail.speciality"/>
                                                            <x-text-input class="mt-2 " x-bind:name="`product_details[${productDetail.id}][m_2]`"  :messages="$errors->get('m_2')" x-model="productDetail.m_2"  @change="calculateValues()" placeholder="M2"/>   

                                                        </td> 
                                                    <td>
                                                        <x-text-input class="bg-gray-100 dark:bg-gray-700" readonly="true" x-bind:name="`product_details[${productDetail.id}][location]`"  :messages="$errors->get('location')" x-model="productDetail.location"/>
                                                            <x-text-input class="mt-2 " x-bind:name="`product_details[${productDetail.id}][m_3]`"  :messages="$errors->get('m_3')" x-model="productDetail.m_3"  @change="calculateValues()" placeholder="M3"/>   
                                                        </td>  
                                                    <td>
                                                        <select class="form-input" name="product_id" x-model="productDetail.product_id" x-bind:name="`product_details[${productDetail.id}][product_id]`"  x-on:change="productChange()" required>
                                                            <option value="" disabled selected>Select Product</option>
                                                                @foreach ($products as $id => $product)
                                                                    <option value="{{$id}}"
                                                                    {{ $id ? ($id == $customer_tracking->product_id ? 'selected' : '') : '' }}> {{$product}} </option>
                                                            @endforeach
                                                        </select>
                                                            <x-text-input class="mt-2 " x-bind:name="`product_details[${productDetail.id}][m_4]`"  :messages="$errors->get('m_4')" x-model="productDetail.m_4"  @change="calculateValues()" placeholder="M4"/>   

                                                    </td>
                                                    <td>
                                                        <x-text-input   class="bg-gray-100 dark:bg-gray-700" style="margin-bottom: 45px;" readonly="true" x-bind:name="`product_details[${productDetail.id}][nrv]`"  :messages="$errors->get('nrv')" x-model="productDetail.nrv"/>
                                                        </td>   
                                                    <td>
                                                        <x-text-input x-bind:name="`product_details[${productDetail.id}][qty]`" style="margin-bottom: 45px;" class="bg-gray-100 dark:bg-gray-700"  :messages="$errors->get('qty')" x-model="productDetail.qty" readonly="true" @change="calculateVal()"/>
                                                        </td>                                              
                                                    <td>
                                                        <x-text-input  x-bind:name="`product_details[${productDetail.id}][val]`" style="margin-bottom: 45px;" class="bg-gray-100 dark:bg-gray-700"  :messages="$errors->get('val')" x-model="productDetail.val" readonly="true" @change="calculateTotal()"/>
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
                                                    <x-text-input class="form-input bg-gray-100 dark:bg-gray-700" x-model="amount" readonly="true" :messages="$errors->get('amount')" value="{{ old('amount', $customer_tracking->amount) }}" name="amount"/>
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
                    <x-cancel-button :link="route('customer_trackings.index')">
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

            @if($customer_tracking->employee_id)
                this.employee_id ={{ $customer_tracking->employee_id }};
                this.mehqChange();
            @endif
                          
            @if($customer_tracking->proposal_date)
                this.proposal_date ='{{  $customer_tracking->proposal_date }}';
            @endif

            @if($customer_tracking->proposal_month)
                this.proposal_month ='{{  $customer_tracking->proposal_month }}';
            @endif

            @if($customer_tracking->amount)
                this.amount ='{{  $customer_tracking->amount }}';
            @endif

            let maxId = 0; 
            id='';
            @if($customer_tracking['CustomerTrackingDetail'])
            @foreach($customer_tracking['CustomerTrackingDetail'] as $i=>$details)
            this.productDetails.push({
                i: ++maxId,
                id: '{{ $details->id }}',
                doctor_id: '{{ $details->doctor_id }}',
                speciality: '{{ $details->speciality }}',
                location: '{{ $details->location }}',
                product_id: '{{ $details->product_id }}',
                nrv: '{{ $details->nrv }}',
                qty: '{{ $details->qty }}',
                val: '{{ $details->val }}',
                m_1: '{{ $details->m_1 }}',
                m_2: '{{ $details->m_2 }}',
                m_3: '{{ $details->m_3 }}',
                m_4: '{{ $details->m_4 }}',
            });                    
            @endforeach
            @endif 
        },

        doctor_id:'',
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
