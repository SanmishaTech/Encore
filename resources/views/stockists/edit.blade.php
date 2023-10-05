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
                <div class="grid grid-cols-4 gap-4 mb-4">      
                    <div>
                        <label>Stockist Name:<span style="color: red">*</span></label>
                        <x-text-input class="form-input" name="stockist" value="{{ old('stockist') ? old('stockist') : $stockist->stockist }}"/>                       
                        <x-input-error :messages="$errors->get('stockist')" class="mt-2" />                       
                    </div>
                    <div>
                        <label>RBM/ZBM :</label>
                        <select class="form-input" name="employee_id_1" x-model="rbm" @change="reportOffice()">
                            <option>Select RBM/ZBM</option>
                            @foreach ($employees as $employee)
                                @if($employee->designation == 'RBM/ZBM')
                                <option value="{{$employee->id}}" {{  $employee->id == $stockist->employee_id_1 ? 'Selected' : '' }}>{{$employee->name}}</option>
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
                            <!-- @foreach ($employees as $employee)
                                @if($employee->designation == "ABM")
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                @endif
                            @endforeach -->
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
