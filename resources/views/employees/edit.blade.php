<x-layout.default>   
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('employees.index') }}" class="text-primary hover:underline">Employees</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('employees.update', ['employee' => $employee->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Employee</h5>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">               
                    <div>
                        <label>Employee Name:<span style="color: red">*</span></label>
                        <x-text-input class="form-input"  name="name" value="{{ $employee->name }}"/>                       
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />   
                    </div>
                    <div>
                        <label>Email:<span style="color: red">*</span></label>
                        <x-email-input  class="form-input" name="email" value="{{ $employee->email }}"/>                       
                        <x-input-error :messages="$errors->get('email')" class="mt-2" /> 
                    </div>
                    <div>                     
                        <label>Contact No 1:<span style="color: red">*</span></label>
                        <x-text-input class="form-input"  name="contact_no_1" value="{{ $employee->contact_no_1 }}"/>  
                        <x-input-error :messages="$errors->get('contact_no_1')" class="mt-2" />    
                    </div>      
                    <div >
                        <label>Contact No 2:<span style="color: red">*</span></label>
                        <x-text-input class="form-input"  name="contact_no_2" value="{{ $employee->contact_no_2 }}"/>                       
                        <x-input-error :messages="$errors->get('contact_no_2')" class="mt-2" />                       
                    </div>          
                </div>     
                <div class="grid grid-cols-1 gap-4 mb-4"> 
                    <div>
                        <label>Address:<span style="color: red">*</span></label>
                        <x-text-input class="form-input" name="address" value="{{ $employee->address }}"/>    
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />  
                    </div> 
                </div> 
                <div class="grid grid-cols-4 gap-4 mb-4"> 
                    <div>
                        <label>Designation :<span style="color: red">*</span></label>
                        <select class="form-input" name="designation">
                            <option>Select Designation</option>
                            <option value="RBM/ZBM" @if ($employee->designation == "RBM/ZBM") {{ 'Selected' }} @endif>RBM / ZBM</option>
                            <option value="ABM" @if ($employee->designation == "ABM") {{ 'Selected' }} @endif>ABM</option>                        
                            <option value="MEHQ" @if ($employee->designation == "MEHQ") {{ 'Selected' }} @endif>ME HQ</option> 
                        </select> 
                        <x-input-error :messages="$errors->get('designation')" class="mt-2" /> 
                    </div>
                    <div>
                        <label>Birthdate:<span style="color: red">*</span></label>
                        <x-text-input id="dob" class="form-input" name="dob" value="{{ $employee->dob }}"/>              
                        <x-input-error :messages="$errors->get('dob')" class="mt-2" /> 
                    </div>
                    <div>                     
                        <label>State:<span style="color: red">*</span></label>
                        <x-text-input class="form-input"  name="state_name" value="{{ $employee->state_name }}"/>  
                        <x-input-error :messages="$errors->get('state_name')" class="mt-2" />    
                    </div>      
                    <div >
                        <label>City:<span style="color: red">*</span></label>
                        <x-text-input class="form-input" name="city" value="{{ $employee->city }}"/>                       
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />                       
                    </div>                              
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Fieldforce Name :<span style="color: red">*</span></label>
                        <x-text-input class="form-input"  name="fieldforce_name" value="{{ $employee->fieldforce_name }}"/> 
                        <x-input-error :messages="$errors->get('fieldforce_name')" class="mt-2" /> 
                    </div>
                    <div>
                        <label>Employee Code:<span style="color: red">*</span></label>
                        <x-text-input class="form-input"  name="employee_code" value="{{ $employee->employee_code }}"/> 
                        <x-input-error :messages="$errors->get('employee_code')" class="mt-2" />
                    </div>  
                </div>   
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label>Reporting Office 1 :</label>
                        <select class="form-input" name="reporting_office_1">
                            <option>Select Office-1</option>
                            @if($employee->designation == 'RBM/ZBM')
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endif
                        </select> 
                        <x-input-error :messages="$errors->get('reporting_office_1')" class="mt-2" /> 
                    </div>
                    <div>
                        <label>Reporting Office 2 :</label>
                        <select class="form-input" name="reporting_office_2">
                            <option>Select Office-2</option>
                            @if($employee->designation == "ABM")
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endif
                        </select> 
                        <x-input-error :messages="$errors->get('reporting_office_2')" class="mt-2" />
                    </div>  
                    <div>
                        <label>Reporting Office 3 :</label>
                        <select class="form-input" name="reporting_office_3">
                            <option>Select Office-3</option>
                            @if($employee->designation == "MEHQ")
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endif
                        </select> 
                        <x-input-error :messages="$errors->get('reporting_office_3')" class="mt-2" />
                    </div>
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
        init() {
            flatpickr(document.getElementById('dob'), {
                dateFormat: 'd/m/Y',
            });
        }
    }));
});   
</script>
</x-layout.default>
