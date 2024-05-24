<x-layout.default>  
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('employees.index') }}" class="text-primary hover:underline">Employees</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Employees</h5>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-text-input name="employee_code" value="{{ old('employee_code') }}" :label="__('Employee Code')" :messages="$errors->get('employee_code')" :require="true"/> 
                    <div class="col-span-3">
                        <x-text-input name="name" value="{{ old('name') }}" :label="__('Employee Name')" :require="true" :messages="$errors->get('name')"/>                     
                    </div>
                </div>     
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-text-input name="communication_email" value="{{ old('communication_email') }}" :label="__('Communication Email')" :messages="$errors->get('communication_email')"/>
                    <x-text-input name="contact_no_1" value="{{ old('contact_no_1') }}" :label="__('Contact No 1')" :messages="$errors->get('contact_no_1')"/> 
                    <x-text-input name="contact_no_2" value="{{ old('contact_no_2') }}" :label="__('Contact No 2')" :messages="$errors->get('contact_no_2')"/>
                    <x-text-input name="dob" type="date" value="{{ old('dob') }}" id="dob" :label="__('DOB')" :messages="$errors->get('dob')"/> 
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-1"> 
                    <x-text-input name="address" value="{{ old('address') }}" :label="__('Address')" :messages="$errors->get('address')"/> 
                </div> 
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">                     
                    <div>
                        <label>State:</label>
                        <select class="form-input" name="state_name">
                            <option value="">Select state</option>
                            <template x-for="state in states" :key="state.code">
                                <option :value="state.name" x-text="state.name"></option>
                            </template>
                        </select> 
                    </div>
                    <x-text-input name="city" value="{{ old('city') }}" :label="__('City')" :messages="$errors->get('city')"/>
                </div>   
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-text-input name="fieldforce_name" value="{{ old('fieldforce_name') }}" :label="__('Fieldforce Name')" :messages="$errors->get('fieldforce_name')"/>
                    <div>
                        <label>Designation :</label>
                        <select class="form-input" name="designation" id="designation" x-model="designation" @change="designationChange()">
                            <option value="Zonal Manager">Zonal Manager</option>
                            <option value="Area Manager">Area Manager</option>
                            <option value="Marketing Executive">Marketing Executive</option>
                            <!-- <option value="TERRITORY MANAGER">TERRITORY MANAGER</option>
                            <option value="REGIONAL BUSINESS MANAGER">REGIONAL BUSINESS MANAGER</option>
                            <option value="ME-BRAND ASSOCIATE">ME-BRAND ASSOCIATE</option>
                            <option value="FIELD SALES OFFICER">FIELD SALES OFFICER</option>
                            <option value="SR. AREA BUSINESS MANAGER">SR. AREA BUSINESS MANAGER</option> -->
                        </select> 
                    </div> 
                    <div x-show="rbmopen">
                        <label>Zonal Manager :</label>
                        <select class="form-input" name="reporting_office_1" id="office_1" x-model="rbm" @change="reportOffice()">
                            <!-- <option value="">Select Office-1</option> -->
                            @foreach ($employees as $employee)
                                @if($employee->designation == 'Zonal Manager')
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                @endif
                            @endforeach
                        </select> 
                    </div>
                    <div x-show="abmopen">
                        <label>Area Manager :</label>
                        <select class="form-input" name="reporting_office_2">
                            <option value="">Select Area Manager</option>
                            <template x-for="list in abm" :key="list.id">
                                <option :value="list.id" x-text="list.name"></option>
                            </template>
                        </select>
                    </div>                      
                </div>
                <hr><br>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-combo-input name="email" type="email" :email="true" value="{{ old('email') }}" :label="__('Email')" :messages="$errors->get('email')" :require="true"/>
                    <x-text-input name="new_password" type="password"  :label="__('Password')" :messages="$errors->get('new_password')"/>
                </div>         
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('employees.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>       
            </div> 
        </form> 
    </div>
</div> 
<script>
document.addEventListener("alpine:init", () => {
    Alpine.data('data', () => ({  
        states: '',    
        init() {
            this.rbmopen = true;
            this.abmopen = true;
            flatpickr(document.getElementById('dob'), {
                dateFormat: 'd/m/Y',
            });
            var options = {
                searchable: true
            };
            NiceSelect.bind(document.getElementById("designation"), options);
            NiceSelect.bind(document.getElementById("office_1"), options);
            // NiceSelect.bind(document.getElementById("office_2"), options);
            // NiceSelect.bind(document.getElementById("office_3"), options);

            this.states = [
                { code: 'AN', name: 'Andaman and Nicobar Islands' },
                { code: 'AP', name: 'Andhra Pradesh' },
                { code: 'AR', name: 'Arunachal Pradesh' },
                { code: 'AS', name: 'Assam' },
                { code: 'BR', name: 'Bihar' },
                { code: 'CG', name: 'Chandigarh' },
                { code: 'CH', name: 'Chhattisgarh' },
                
                { code: 'DN', name: 'Dadra and Nagar Haveli' },
                { code: 'DD', name: 'Daman and Diu' },
                { code: 'DL', name: 'Delhi' },
                { code: 'GA', name: 'Goa' },
                { code: 'GJ', name: 'Gujarat' },
                { code: 'HR', name: 'Haryana' },
                { code: 'HP', name: 'Himachal Pradesh' },

                { code: 'JK', name: 'Jammu and Kashmir' },
                { code: 'JH', name: 'Jharkhand' },
                { code: 'KA', name: 'Karnataka' },
                { code: 'KL', name: 'Kerala' },
                { code: 'LA', name: 'Ladakh' },
                { code: 'LD', name: 'Lakshadweep' },
                { code: 'MP', name: 'Madhya Pradesh' },
                
                { code: 'MH', name: 'Maharashtra' },
                { code: 'MN', name: 'Manipur' },
                { code: 'ML', name: 'Meghalaya' },
                { code: 'MZ', name: 'Mizoram' },
                { code: 'NL', name: 'Nagaland' },
                { code: 'OR', name: 'Odisha' },
                { code: 'PY', name: 'Puducherry' },
                
                { code: 'PB', name: 'Punjab' },
                { code: 'RJ', name: 'Rajasthan' },
                { code: 'SK', name: 'Sikkim' },
                { code: 'TN', name: 'Tamil Nadu' },
                { code: 'TS', name: 'Telangana' },
                { code: 'TR', name: 'Tripura' },
                { code: 'UP', name: 'Uttar Pradesh' },
                { code: 'UK', name: 'Uttarakhand' },
                { code: 'WB', name: 'West Bengal' },
            ];
        },

        rbm: '',
        abm: '',
        async reportOffice() {               
            this.abm = await (await fetch('/employees/'+ this.rbm, {
                method: 'GET',
                headers: {
                    'Content-type': 'application/json;',
                },
            })).json();
            console.log(this.abm); 
        },   

        designation: '',
        designationChange(){
            if (this.designation == 'Zonal Manager') {
                this.rbmopen = false;
                this.abmopen = false;
            } else if (this.designation == 'Area Manager') {
                this.rbmopen = true;
                this.abmopen = false;
            } else if (this.designation == 'Marketing Executive') {
                this.rbmopen = true;
                this.abmopen = true;
            } else {
                this.rbmopen = true;
                this.abmopen = true;
            }
        }
    }));
});
</script>
</x-layout.default>
