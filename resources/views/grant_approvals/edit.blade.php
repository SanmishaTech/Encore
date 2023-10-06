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
                        <label>RBM/ZBM :</label>
                        <select class="form-input" name="employee_id_1" x-model="rbm" @change="reportOffice()">
                            <option>Select RBM/ZBM</option>
                            @foreach ($employees as $employee)
                                @if($employee->designation == 'RBM/ZBM')
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                @endif
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_1')" class="mt-2" /> 
                    </div>
                    <div>
                        <label>ABM :</label>
                        <select class="form-input" name="employee_id_2" @change="reportOfficeME()" x-model="abml">
                            <option>Select ABM</option>
                            <template x-for="list in abm" :key="list.id">
                                <option :value="list.id" x-text="list.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_2')" class="mt-2" />
                    </div>  
                    <div>
                        <label>ME HQ :</label>
                        <select class="form-input" name="employee_id_3">
                            <option>Select ME HQ</option>
                            <template x-for="me in mehq" :key="me.id">
                                <option :value="me.id" x-text="me.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_3')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Doctor :</label>
                        <select class="form-input" name="doctor_id">
                            <option>Select Doctor</option>
                            @foreach ($doctors as $id => $doctor)
                                <option value="{{$id}}" {{ $grant_approval->doctor_id ? ($grant_approval->doctor_id == $id ? 'Selected' : '' ) : ''}}>{{$doctor}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" /> 
                    </div>
                    <x-text-input name="mpl_no" value="{{ old('mpl_no', $grant_approval->mpl_no) }}" :label="__('MPL No')"  :messages="$errors->get('mpl_no')"/>
                    <x-text-input name="speciality" value="{{ old('speciality', $grant_approval->speciality) }}" :label="__('Speciality')"  :messages="$errors->get('speciality')"/>
                    <x-text-input name="location" value="{{ old('location', $grant_approval->location) }}" :label="__('Location')"  :messages="$errors->get('location')"/>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Activity :</label>
                        <select class="form-input" name="activity_id">
                            <option>Select Activity</option>
                            @foreach ($activities as $id => $activity)
                                <option value="{{$id}}" {{ $grant_approval->activity_id ? ($grant_approval->activity_id == $id ? 'Selected' : '' ) : ''}}>{{$activity}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('activity_id')" class="mt-2" /> 
                    </div>
                    <x-text-input name="date" value="{{ old('date', $grant_approval->date) }}" :label="__('Date')"  :messages="$errors->get('date')" type="date"/>
                    <x-text-input name="proposal_date" value="{{ old('proposal_date', $grant_approval->proposal_date) }}" type="date" :label="__('Proposal Date')"  :messages="$errors->get('proposal_date')"/>                    
                </div>       
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-text-input name="code" value="{{ old('code', $grant_approval->code) }}" :label="__('Code')"  :messages="$errors->get('code')"/>
                    <x-combo-input name="amount" value="{{ old('amount', $grant_approval->amount) }}" :label="__('Amount')"  :messages="$errors->get('amount')"/>
                    <x-combo-input name="email" value="{{ old('email', $grant_approval->email) }}" :email="true" :require="true" :label="__('Email')"  :messages="$errors->get('email')"/>
                </div> 
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('stockists.index')">
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
         
        mehq: '',
        abml:'',
        async reportOfficeME() {
            this.mehq = await (await fetch('/employees/getReportingOfficer3/'+ this.abml, {
                method: 'GET',
                headers: {
                    'Content-type': 'application/json;',
                },
            })).json();
            console.log(this.mehq);
        },
    }));
});
</script>
</x-layout.default>
