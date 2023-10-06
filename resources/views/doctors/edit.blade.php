<x-layout.default>   
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('doctors.index') }}" class="text-primary hover:underline">Doctors</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('doctors.update', ['doctor' => $doctor->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Doctors</h5>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">        
                    <x-text-input name="doctor_name" value="{{ old('doctor_name', $doctor->doctor_name) }}" :label="__('Doctor Name')" :require="true" :messages="$errors->get('doctor_name')"/>                       
                    <x-text-input name="hospital_name" value="{{ old('hospital_name', $doctor->hospital_name) }}" :label="__('Hospital Name')" :require="true" :messages="$errors->get('hospital_name')"/>  
                </div>   
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-combo-input name="email" type="email" :email="true" value="{{ old('email', $doctor->email) }}" :require="true" :label="__('Email')" :messages="$errors->get('email')"/>                      
                    <x-text-input name="contact_no_1" value="{{ old('contact_no_1', $doctor->contact_no_1) }}" :label="__('Contact No 1')" :messages="$errors->get('contact_no_1')"/>   
                    <x-text-input name="contact_no_2" value="{{ old('contact_no_2', $doctor->contact_no_2) }}" :label="__('Contact No 2')" :messages="$errors->get('contact_no_2')"/>
                </div>  
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-text-input name="dob" value="{{ old('dob', $doctor->dob) }}" id="dob" :label="__('DOB')" :messages="$errors->get('dob')"/>
                    <x-text-input name="dow" value="{{ old('dow', $doctor->dow) }}" id="dow" :label="__('DOW')" :messages="$errors->get('dow')"/>
                    <x-text-input name="state" value="{{ old('state', $doctor->state) }}" :label="__('State')" :messages="$errors->get('state')"/> 
                    <x-text-input name="city" value="{{ old('city', $doctor->city) }}" :label="__('City')" :messages="$errors->get('city')"/>         
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Employee:</label>
                        <select class="form-input" name="employee">
                            <option>Select employee</option>                            
                            @foreach ($employees as $id => $employee)
                                    <option value="{{$id}}" {{ $doctor->employee ? ($doctor->employee == $id ? 'Selected' : '' ) : ''}}>{{$employee}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee')" class="mt-2" />

                    </div>
                    <div>
                        <label>Territory:</label>
                        <select class="form-input" name="territory">
                            <option>Select Territory</option>                            
                            @foreach ($territories as $id => $territory)
                                    <option value="{{$id}}" {{ $doctor->territory ? ($doctor->territory == $id ? 'Selected' : '' ) : ''}}>{{$territory}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('territory')" class="mt-2" />
                    </div>
                    <div>
                        <label>Category:</label>
                        <select class="form-input" name="category">
                            <option>Select Category</option>                            
                            @foreach ($categories as $id => $category)
                                    <option value="{{$id}}" {{ $doctor->category ? ($doctor->category == $id ? 'Selected' : '' ) : ''}}>{{$category}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>
                    <div>
                        <label>Type:</label>
                        <select class="form-input" name="type">
                            <option>Select Type</option> 
                            <option value="ex" @if ($doctor->type == 'ex') {{ 'Selected' }} @endif>EX</option>
                            <option value="hq" @if ($doctor->type == 'hq') {{ 'Selected' }} @endif>HQ</option>
                        </select> 
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4"> 
                    <div>
                        <label>Qualification:</label>
                        <select class="form-input" name="qualification">
                            <option>Select Qualification</option>                            
                            @foreach ($qualifications as $id => $qualification)
                                    <option value="{{$id}}" {{ $doctor->qualification ? ($doctor->qualification == $id ? 'Selected' : '' ) : ''}}>{{$qualification}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('qualification')" class="mt-2" />
                    </div>
                    <x-text-input name="speciality" value="{{ old('speciality', $doctor->speciality) }}" :label="__('Speciality')" :messages="$errors->get('speciality')"/> 
                    <x-text-input name="class" value="{{ old('class', $doctor->class) }}" :label="__(' Class')" :messages="$errors->get('class')"/>           
                    <x-text-input name="mpl_no" value="{{ old('mpl_no', $doctor->mpl_no) }}" :label="__(' MPL No')" :messages="$errors->get('mpl_no')"/> 
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">   
                    <x-text-input name="designation" value="{{ old('designation', $doctor->designation) }}" :label="__('Designation')" :messages="$errors->get('designation')"/>                        
                    <x-text-input name="hq" value="{{ old('hq', $doctor->hq) }}" :label="__('HQ')" :messages="$errors->get('hq')"/>
                </div> 
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <x-text-input name="doctor_address" value="{{ old('doctor_address', $doctor->doctor_address) }}" :label="__('Doctor Address')" :messages="$errors->get('doctor_address')"/>   
                </div> 
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <x-text-input name="hospital_address" value="{{ old('hospital_address', $doctor->hospital_address) }}" :label="__('Hospital Address')" :messages="$errors->get('hospital_address')"/>       
                </div> 
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('doctors.index')">
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
            
            flatpickr(document.getElementById('dow'), {
                dateFormat: 'd/m/Y',
            });   
        },     
    }));
});   
</script>
</x-layout.default>
