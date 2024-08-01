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
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">  
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" name="code" value="{{ old('code') ? old('code') : $grant_approval->code }}" :label="__('Code')" :messages="$errors->get('code')" readonly="true"/>
                    <div>
                        <label>Marketing Executive : <span class=text-danger>*</span></label>
                        <select class="form-input" name="employee_id" x-model="employee_id" @change="mehqChange()">
                            <option>Select Marketing Executive</option>
                            @foreach ($employees as $id=>$employee)                                
                                <option value="{{$id}}" {{ $id ? ($id == $grant_approval->employee_id ? 'Selected' : '') : '' }}>{{$employee}}</option>                                
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_1')" class="mt-2" />
                    </div>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Area Manager')"  :messages="$errors->get('employee_id_2')" x-model="area" readonly="true"/>                       
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Zonal Manager')"  :messages="$errors->get('employee_id_2')" x-model="zone" readonly="true"/>                      
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Doctor: <span class=text-danger>*</span></label>
                            <select class="form-select" name="doctor_id" @change="doctorChange()" x-model="doctor_id">                                
                                @if(auth()->user()->roles->pluck('name')->first() == "Marketing Executive")
                                    <option value="" disabled selected >Select Doctor</option>
                                    @foreach ($doctors as $id=>$doctor)                                
                                        <option value="{{$id}}">{{$doctor}}</option>                                
                                    @endforeach      
                                @else
                                    <template x-for="doctor in doctors" :key="doctor.id">
                                        <option :value="doctor.id" x-text="doctor.doctor_name" :selected='doctor.id == doctor_id' selected="selected"></option>
                                    </template>
                                @endif
                            </select>
                        <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" /> 
                    </div>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" x-model="mpl_no" :label="__('MPL No')"  :messages="$errors->get('mpl_no')" readonly="true"/>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700"  x-model="speciality"   :label="__('Speciality')"  :messages="$errors->get('speciality')" readonly="true"/>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" x-model="location" :label="__('Location')"  :messages="$errors->get('location')" readonly="true"/>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Activity : <span class=text-danger>*</span></label>
                        <select class="form-input" name="activity_id">
                            <option value="" disabled selected >Select Activity</option>
                            @foreach ($activities as $id => $activity)
                                <option value="{{$id}}" {{ $grant_approval->activity_id ? ($grant_approval->activity_id == $id ? 'Selected' : '') : '' }}>{{$activity}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('activity_id')" class="mt-2" /> 
                    </div>
                    <x-text-input name="date_of_issue" id="date" value="{{ old('date_of_issue', $grant_approval->date_of_issue) }}"  :require="true" x-model="date_of_issue" x-on:change.debounce="dateChange()" :label="__('Date')"  :messages="$errors->get('date_of_issue')"/>
                    <x-text-input class="bg-gray-100 dark:bg-gray-700" :label="__('Proposal Month')"  x-model="proposal_month" value="{{ old('proposal_month', $grant_approval->proposal_month) }}" name="proposal_month" :messages="$errors->get('proposal_month')" readonly="true"/> 
                    <!-- <div>
                        <label>Proposal Month :<span style="color: red">*</span></label>
                        <select class="form-input" name="proposal_month">
                            <option>Select Proposal Month</option>
                            <template x-for="list in lists" :key="list.key">
                                <option :value="list" x-text="list.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('designation')" class="mt-2" /> 
                    </div> -->
                </div>       
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-combo-input name="proposal_amount" value="{{ old('proposal_amount',$grant_approval->proposal_amount) }}"   :require="true" :label="__('Proposal Amount')"  :messages="$errors->get('proposal_amount')"/>
                    <x-combo-input name="email" value="{{ old('email',$grant_approval->email) }}" :email="true" :require="true" :label="__('Email')"  :messages="$errors->get('email')"/>
                    <x-text-input name="contact_no" value="{{ old('contact_no', $grant_approval->contact_no) }}" :label="__('Contact No')"  :messages="$errors->get('contact_no')"/>
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
<div class="table-responsive">
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
</div>
                @endif
            </div>
        </form> 

      
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
document.addEventListener("alpine:init", () => {
    Alpine.data('data', () => ({ 
        doctor_id: '',
        zone: '',
        area: '',
        employee_id: '',
        employee_id_2: '',
        employee_id_3: '',
        doctorData: '',
        location: '',
        speciality: '',
        mpl_no: '',
        doctors:'',     
        date_of_issue : '',
        proposal_month: '',
        init() {
            flatpickr(document.getElementById('date'), {
                dateFormat: 'd/m/Y',
            });           

            @if($grant_approval->doctor_id)
                this.doctor_id = {{ $grant_approval->doctor_id }};
                this.doctorChange();
            @endif

            @if($grant_approval->employee_id)
                this.employee_id ={{  $grant_approval->employee_id }};
                this.mehqChange();
            @endif
                          
            @if($grant_approval->date_of_issue)
                this.date_of_issue ='{{  $grant_approval->date_of_issue }}';
            @endif

            @if($grant_approval->proposal_month)
                this.proposal_month ='{{  $grant_approval->proposal_month }}';
            @endif
        },
        
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
            console.log(this.doctor_id);      
        },        
       
        dateChange(){     
            this.proposal_month = moment(this.date_of_issue, 'DD/MM/YYYY').format("MMM / YYYY");
        },

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
            console.log(this.doctors)
        },

        monthChange(){
            var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            data = ['2023', '2024', '2025'];
            monthList = [];
            count = 0;
            for(let y in data){
                for(let m in months){
                        
                     monthList[count] =  {
                            key : months[m]+" / "+ data[y],
                            name : months[m]+" / "+ data[y],

                        };
                     count++;
                }
            }

            this.lists = monthList;
           
        }
    }));
});
</script>
</x-layout.default>
