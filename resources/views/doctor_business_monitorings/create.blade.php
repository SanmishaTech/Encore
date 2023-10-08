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
                        <label>ME HQ :</label>
                        <select class="form-input" name="employee_id_1" readonly="true"  x-model="employee_id_1">
                            <option>Select MEHQ</option>
                            <option key="manager.id" :value="manager.id" x-text="manager.name" ></option>
                        </select>
                    </div>
                    <div>
                        <label>ABM :</label>
                        <select class="form-input" name="employee_id_2" readonly="true"  x-model="employee_id_2">
                            <option>Select ABM</option>
                            <option key="area.id" :value="area.id" x-text="area.name" ></option>
                        </select>
                    </div>
                    <div>
                        <label>RBM/ZBM :</label>
                        <select class="form-input" name="employee_id_3" readonly="true"  x-model="employee_id_3">
                            <option>Select RBM/ZBM</option>
                            <option key="zone.id" :value="zone.id" x-text="zone.name" ></option>
                        </select> 
                    </div>                    
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Doctor:</label>
                        <select class="form-input" name="doctor_id" readonly="true"  x-model="doctor_id">
                            <option>Select Doctor</option>
                            <option key="docData.id" :value="docData.id" x-text="docData.doctor_name" ></option>
                        </select> 
                    </div>  
                    <x-text-input name="mpl_no" x-model="mpl_no" value="{{ old('mpl_no') }}" :label="__('MPL NO')"  :messages="$errors->get('mpl_no')"/>
                    <x-text-input name="speciality" x-model="speciality" value="{{ old('speciality') }}" :label="__('Speciality')"  :messages="$errors->get('speciality')"/>
                    <x-text-input name="location" x-model="location" value="{{ old('location') }}" :label="__('Location')"  :messages="$errors->get('location')"/>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-text-input name="date" x-model="date" value="{{ old('date') }}" type="date" id="date" :label="__('Date')"  :messages="$errors->get('date')"/>
                    <x-text-input name="month" x-model="month" value="{{ old('month') }}" type="date" id="month" :label="__('Proposal Month')"  :messages="$errors->get('month')"/>      
                    <x-combo-input name="amount" x-model="amount" value="{{ old('amount') }}" :label="__('Amount')"  :messages="$errors->get('amount')"/>
                    <x-text-input name="roi" value="{{ old('roi') }}" :label="__('ROI')"  :messages="$errors->get('roi')"/>
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

            flatpickr(document.getElementById('month'), {
                dateFormat: 'M',
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
            console.log(this.data)
            this.manager = this.data.manager;
            this.area = this.data.area_manager;
            this.zone = this.data.zonal_manager;
            this.docData = this.data.doctor;
            this.mpl_no = this.data.mpl_no;
            this.location = this.data.location;
            this.speciality = this.data.speciality;
            this.date = this.data.date;
            this.month = this.data.proposal_date;
            this.amount = this.data.amount;
        }
    }));
});
</script> 
</x-layout.default>
