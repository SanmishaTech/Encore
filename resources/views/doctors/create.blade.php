<x-layout.default>  
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('doctors.index') }}" class="text-primary hover:underline">Doctor</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('doctors.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Doctor</h5>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4"> 
                    <x-text-input name="doctor_name" value="{{ old('doctor_name') }}" :label="__('Doctor Name')" :require="true" :messages="$errors->get('doctor_name')"/>  
                    <x-text-input name="hospital_name" value="{{ old('hospital_name') }}" :label="__('Hospital Name')" :require="true" :messages="$errors->get('hospital_name')"/> 
                </div>   
                <div class="grid grid-cols-4 gap-4 mb-4">  
                    <x-combo-input name="email" type="email" :email="true" value="{{ old('email') }}" :require="true" :label="__('Email')" :messages="$errors->get('email')"/>  
                    <x-text-input name="contact_no_1" value="{{ old('contact_no_1') }}" :label="__('Contact No 1')" :messages="$errors->get('contact_no_1')"/>  
                    <x-text-input name="contact_no_2" value="{{ old('contact_no_2') }}" :label="__('Contact No 2')" :messages="$errors->get('contact_no_2')"/>   
                </div>  
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-text-input name="dob" value="{{ old('dob') }}" id="dob" :label="__('DOB')" :messages="$errors->get('dob')"/>
                    <x-text-input name="dow" value="{{ old('dow') }}" id="dow" :label="__('DOW')" :messages="$errors->get('dow')"/>
                    <x-text-input name="state" value="{{ old('state') }}" :label="__('State')" :messages="$errors->get('state')"/>  
                    <x-text-input name="city" value="{{ old('city') }}" :label="__('City')" :messages="$errors->get('city')"/>  
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Employee:</label>
                        <select class="form-input" name="employee_id">
                            <option>Select employee</option>                            
                            @foreach ($employees as $id => $employee)
                                    <option value="{{$id}}">{{$employee}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                    </div>
                    <div>
                        <label>Territory:</label>
                        <select class="form-input" name="territory_id">
                            <option>Select Territory</option>                            
                            @foreach ($territories as $id => $territory)
                                    <option value="{{$id}}">{{$territory}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('territory_id')" class="mt-2" />
                    </div>
                    <div>
                        <label>Category:</label>
                        <select class="form-input" name="category_id">
                            <option>Select Category</option>                            
                            @foreach ($categories as $id => $category)
                                    <option value="{{$id}}">{{$category}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>
                    <div>
                        <label>Type:</label>
                        <select class="form-input" name="type">
                            <option>Select Type</option> 
                            <option value="ex">EX</option>
                            <option value="hq">HQ</option>
                        </select> 
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4"> 
                    <div>
                        <label>Qualification:</label>
                        <select class="form-input" name="qualification_id">
                            <option>Select Qualification</option>                            
                            @foreach ($qualifications as $id => $qualification)
                                    <option value="{{$id}}">{{$qualification}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('qualification_id')" class="mt-2" />
                    </div>
                    <x-text-input name="speciality" value="{{ old('speciality') }}" :label="__('Speciality')" :messages="$errors->get('speciality')"/>       
                    <x-text-input name="class" value="{{ old('class') }}" :label="__(' Class')" :messages="$errors->get('class')"/>  
                    <x-text-input name="mpl_no" value="{{ old('mpl_no') }}" :label="__(' MPL No')" :messages="$errors->get('mpl_no')"/>     
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">       
                    <x-text-input name="designation" value="{{ old('designation') }}" :label="__('Designation')" :messages="$errors->get('designation')"/>  
                    <x-text-input name="hq" value="{{ old('hq') }}" :label="__('HQ')" :messages="$errors->get('hq')"/>  
                </div> 
                <div class="grid grid-cols-1 gap-4 mb-4"> 
                    <x-text-input name="doctor_address" value="{{ old('doctor_address') }}" :label="__('Doctor Address')" :messages="$errors->get('doctor_address')"/> 
                </div> 
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <x-text-input name="hospital_address" value="{{ old('hospital_address') }}" :label="__('Hospital Address')" :messages="$errors->get('hospital_address')"/>  
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
