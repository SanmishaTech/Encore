<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('stockists.index') }}" class="text-primary hover:underline">Stockists</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('stockists.update', ['stockist' => $stockist->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Stockist</h5>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">     
                    <x-text-input name="stockist" value="{{ old('stockist', $stockist->stockist) }}" :label="__('Stockist Name')" :require="true" :messages="$errors->get('stockist')"/>               
                    <div>
                        <label>Zonal Manager :<span style="color: red">*</span></label>
                        <select class="form-input" name="employee_id_1" id="employee_id_1" x-model="rbm" @change="reportOffice()">
                            <option>Select Zonal Manager</option>
                            @foreach ($employees as $employee)
                                @if($employee->designation == 'Zonal Manager')
                                <option value="{{$employee->id}}" {{  $employee->id == $stockist->employee_id_1 ? 'Selected' : '' }}>{{$employee->name}}</option>
                                @endif
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_1')" class="mt-2" /> 
                    </div>
                    <div>
                        <label>Area Manager :<span style="color: red">*</span></label>
                        <select class="form-input" name="employee_id_2"  @change="reportOfficeME()" x-model="abml">
                            <option>Select Area Manager</option>
                            <template x-for="list in abm" :key="list.id">
                                <option :value="list.id"  :selected='list.id == abml' x-text="list.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_2')" class="mt-2" />
                    </div>  
                    <div>
                        <label>Marketing Executive:<span style="color: red">*</span></label>
                        <select class="form-input" name="employee_id_3" x-model="manager">
                            <option>Select Marketing Executive</option>
                            <template x-for="me in mehq" :key="me.id">
                                <option :value="me.id"  :selected='me.id == manager' x-text="me.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id_3')" class="mt-2" />
                    </div>                  
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">  
                    <x-text-input name="contact_no" value="{{ old('contact_no', $stockist->contact_no) }}" :label="__('Contact No')" :messages="$errors->get('contact_no')"/> 
                    <x-text-input name="cfa_email" value="{{ old('cfa_email', $stockist->cfa_email) }}" :label="__('CFA Email')" :messages="$errors->get('cfa_email')"/>     
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

        init() {          
            this.abm = '';
            this.rbm = '';
            this.mehq = '';
            this.manager = '';
            @if($stockist->employee_id_1)
                this.rbm = '{{  $stockist->employee_id_1 }}';
                this.reportOffice();
            @endif

            @if($stockist->employee_id_2)
                this.abml = '{{  $stockist->employee_id_2 }}';
                this.reportOfficeME();
            @endif

            @if($stockist->employee_id_3)
                this.manager = '{{  $stockist->employee_id_3 }}';
            @endif
              
            
            var options = {
                searchable: true
            };
            NiceSelect.bind(document.getElementById("employee_id_1"), options);
            // NiceSelect.bind(document.getElementById("employee_id_2"), options);
            // NiceSelect.bind(document.getElementById("employee_id_3"), options);
        },

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
