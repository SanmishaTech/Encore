<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('grant_approvals.index') }}" class="text-primary hover:underline">Grant Approval</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('grant_approvals.update', ['grant_approval' => $grant_approval->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Grant Approval</h5>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">  
                    <div>
                        <label>ME HQ :</label>
                        <select class="form-input" name="employee_id_1" x-model="employee_id_1" @change="mehqChange()">
                            <option>Select ME HQ</option>
                            @foreach ($employees as $id=>$employee)                                
                                <option value="{{$id}}">{{$employee}}</option>                                
                            @endforeach
                            
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_1')" class="mt-2" />
                    </div>
                    
                    <div>
                        <label>ABM :</label>
                        <select class="form-input" name="employee_id_2" readonly="true"  x-model="employee_id_2">
                            <option>Select ABM</option>
                            <option key="area.id" :value="area.id" x-text="area.name" ></option>
                            
                            
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_2')" class="mt-2" />
                    </div>  
                   
                    <div>
                        <label>RBM/ZBM :</label>
                        <select class="form-input" name="employee_id_3" readonly="true"  x-model="employee_id_3">
                            <option>Select RBM/ZBM</option>
                            <option key="zone.id" :value="zone.id" x-text="zone.name" ></option>
                           
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_3')" class="mt-2" /> 
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Doctor :</label>
                        <select class="form-input" name="doctor_id" @change="doctorChange()" x-model="doctor_id">
                            <option>Select Doctor</option>
                            @foreach ($doctors as $id => $doctor)
                                <option value="{{$id}}" {{ $id ? ($id == $grant_approval->doctor_id ? 'Selected' : '') : '' }}>{{$doctor}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" /> 
                    </div>
                    <x-text-input name="mpl_no" x-model="mpl_no" value="{{ old('mpl_no', $grant_approval->mpl_no) }}" :label="__('MPL No')"  :messages="$errors->get('mpl_no')" />
                    <x-text-input name="speciality" x-model="speciality"  value="{{ old('speciality', $grant_approval->speciality) }}" :label="__('Speciality')"  :messages="$errors->get('speciality')" />
                    <x-text-input name="location" x-model="location" value="{{ old('location', $grant_approval->location) }}" :label="__('Location')"  :messages="$errors->get('location')" />
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Activity :</label>
                        <select class="form-input" name="activity_id">
                            <option>Select Activity</option>
                            @foreach ($activities as $id => $activity)
                                <option value="{{$id}}">{{$activity}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('activity_id')" class="mt-2" /> 
                    </div>
                    <x-text-input name="date" id="date" value="{{ old('date', $grant_approval->date) }}" :label="__('Date')"  :messages="$errors->get('date')"/>
                    <x-text-input name="proposal_date" id="proposal_date" value="{{ old('proposal_date',$grant_approval->proposal_date) }}" :label="__('Proposal Date')"  :messages="$errors->get('proposal_date')"/>                    
                </div>       
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-text-input name="code" value="{{ old('code') }}" :label="__('Code')" :messages="$errors->get('code')" readonly="true"/>
                    <x-combo-input name="amount" value="{{ old('amount',$grant_approval->amount) }}" :label="__('Amount')"  :messages="$errors->get('amount')"/>
                    <x-combo-input name="email" value="{{ old('email',$grant_approval->email) }}" :email="true" :require="true" :label="__('Email')"  :messages="$errors->get('email')"/>
                </div> 
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('grant_approvals.index')">
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

            flatpickr(document.getElementById('proposal_date'), {
                dateFormat: 'd/m/Y',
            });
        },

        doctor_id: '',
        zone: '',
        area: '',
        employee_id_1: '',
        employee_id_2: '',
        employee_id_3: '',
        doctorDate: '',
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

        async mehqChange() {
            this.data = await (await fetch('/employees/getEmployees/'+ this.employee_id_1, {
                
            method: 'GET',
            headers: {
                'Content-type': 'application/json;',
            },
            })).json();
            this.area = this.data.area_manager;
            this.zone = this.data.zonal_manager;
            console.log(this.data.area_manager.name);
        }
    }));
});
</script>
</x-layout.default>
