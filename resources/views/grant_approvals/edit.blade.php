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
                        <label>Managing Executive :</label>
                        <select class="form-input" name="employee_id_1" x-model="employee_id_1" @change="mehqChange()">
                            <option>Select Managing Executive</option>
                            @foreach ($employees as $id=>$employee)                                
                                <option value="{{$id}}">{{$employee}}</option>                                
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_1')" class="mt-2" />
                    </div>
                    <div>
                        <label>Area Manager :</label>
                        <select class="form-input" name="employee_id_2" readonly="true"  x-model="employee_id_2">
                            <option>Select Area Manager</option>
                            <option key="area.id" :value="area.id" x-text="area.name" ></option>
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_2')" class="mt-2" />
                    </div> 
                    <div>
                        <label>Zonal Manager :</label>
                        <select class="form-input" name="employee_id_3" readonly="true"  x-model="employee_id_3">
                            <option>Select Zonal Manager</option>
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
                                <option value="{{$id}}" {{ $grant_approval->activity_id ? ($grant_approval->activity_id == $id ? 'Selected' : '') : '' }}>{{$activity}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('activity_id')" class="mt-2" /> 
                    </div>
                    <x-text-input name="date" id="date" value="{{ old('date', $grant_approval->date) }}" :label="__('Date')"  :messages="$errors->get('date')"/>
                    <!-- <x-text-input name="proposal_month" value="{{ old('proposal_month',$grant_approval->proposal_month) }}" :label="__('Proposal Month')"  :messages="$errors->get('proposal_date')"/>                     -->
                    <div>
                        <label>Proposal Month :<span style="color: red">*</span></label>
                        <select class="form-input" name="proposal_month">
                            <option>Select Proposal Month</option>
                            <option value="Jan /2023" @if ($grant_approval->proposal_month == "Jan /2023") {{ 'Selected' }} @endif>Jan /2023</option>
                            <option value="Feb /2023" @if ($grant_approval->proposal_month == "Feb /2023") {{ 'Selected' }} @endif>Feb /2023</option>
                            <option value="Mar /2023" @if ($grant_approval->proposal_month == "Mar /2023") {{ 'Selected' }} @endif>Mar /2023</option>
                            <option value="Apr /2023" @if ($grant_approval->proposal_month == "Apr /2023") {{ 'Selected' }} @endif>Apr /2023</option>
                            <option value="May /2023" @if ($grant_approval->proposal_month == "May /2023") {{ 'Selected' }} @endif>May /2023</option>
                            <option value="Jun /2023" @if ($grant_approval->proposal_month == "Jun /2023") {{ 'Selected' }} @endif>Jun /2023</option>
                            <option value="Jul /2023" @if ($grant_approval->proposal_month == "Jul /2023") {{ 'Selected' }} @endif>Jul /2023</option>
                            <option value="Aug /2023" @if ($grant_approval->proposal_month == "Aug /2023") {{ 'Selected' }} @endif>Aug /2023</option>
                            <option value="Sep /2023" @if ($grant_approval->proposal_month == "Sep /2023") {{ 'Selected' }} @endif>Sep /2023</option>
                            <option value="Oct /2023" @if ($grant_approval->proposal_month == "Oct /2023") {{ 'Selected' }} @endif>Oct /2023</option>
                            <option value="Nov /2023" @if ($grant_approval->proposal_month == "Nov /2023") {{ 'Selected' }} @endif>Nov /2023</option>
                            <option value="Dec /2023" @if ($grant_approval->proposal_month == "Dec /2023") {{ 'Selected' }} @endif>Dec /2023</option>
                        </select> 
                        <x-input-error :messages="$errors->get('designation')" class="mt-2" /> 
                    </div>
                </div>       
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-text-input name="code" value="{{ old('code') ? old('code') : $grant_approval->code }}" :label="__('Code')" :messages="$errors->get('code')" readonly="true"/>
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
                @if($grant_approval['GrantApprovalDetail'])
                    <br><br>
                    <h5 class="md:absolute  md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Grant Approval Deatils
                    </h5> <br> <br>

                    <table class="whitespace-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Employee</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach ($grant_approval['GrantApprovalDetail'] as $id=>$detail)
                                <tr> 
                                    <td>{{ @$id+1 }}</td>           
                                    <td> &#8377; {{ @$detail->amount }}</td>
                                    <td>{{ @$detail->status }}</td>
                                    <td>   {{ @$detail->Employee->designation }} -  {{ @$detail->Employee->name }}</td>
                                    <td>{{ @$detail->created_at->format('d/m/Y h:m a') }}</td>  
                                </tr>
                            @endforeach
                    </tbody>
                    </table>
                @endif
            </div>
        </form> 

      
    </div>
</div>
<script>
document.addEventListener("alpine:init", () => {
    Alpine.data('data', () => ({      
        init() {
            @if($grant_approval->doctor_id)
                this.doctor_id = {{ $grant_approval->doctor_id }};
                this.doctorChange();
            @endif

            @if($grant_approval->employee_id_1)
                this.employee_id_1 ={{  $grant_approval->employee_id_1 }};
                this.mehqChange();
            @endif
            flatpickr(document.getElementById('date'), {
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
