<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('chemists.index') }}" class="text-primary hover:underline">Chemists</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('chemists.update', ['chemist'=>$chemist->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Chemist</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">   
                    <x-text-input name="chemist" value="{{ old('chemist', $chemist->chemist) }}" :label="__('Chemist Name')" :require="true" :messages="$errors->get('chemist')"/>                       
                    <x-text-input  name="class" value="{{ old('class', $chemist->class) }}" :label="__('Class')" :messages="$errors->get('class')"/> 
                    <div>
                        <label>Employee :<span style="color: red">*</span></label>
                        <select class="form-input" name="employee_id"  id="employee_id">
                            <option>Select Employee</option>
                            @foreach ($employees as $id=>$employee)                                
                                <option value="{{$id}}" {{ $chemist->employee_id ? ($chemist->employee_id == $id ? 'Selected' : '' ) : ''}}>{{$employee}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" /> 
                    </div>
                    <div>
                        <label>Territory :<span style="color: red">*</span></label>
                        <select class="form-input" name="territory_id" id="territory_id">
                            <option>Select Territory</option>
                            @foreach ($territories as $id=>$territory)                                
                                <option value="{{$id}}" {{ $chemist->territory_id ? ($chemist->territory_id == $id ? 'Selected' : '' ) : ''}} >{{$territory}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('territory_id')" class="mt-2" /> 
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">      
                    <x-text-input name="contact_no_1" value="{{ old('contact_no_1', $chemist->contact_no_1) }}" :label="__('Contact No 1')" :messages="$errors->get('contact_no_1')" :require="true"/>  
                    <x-text-input name="contact_no_2" value="{{ old('contact_no_2', $chemist->contact_no_2) }}" :label="__('Contact No 2')" :messages="$errors->get('contact_no_2')"/>  
                    <x-combo-input name="email" :email="true" value="{{ old('email', $chemist->email) }}" :label="__('Email')" :messages="$errors->get('email')"/>  
                    <x-text-input name="contact_person" value="{{ old('contact_person', $chemist->contact_person) }}" :label="__('Contact Person')" :messages="$errors->get('contact_person')"/> 
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-1">  
                    <x-text-input name="address" value="{{ old('address', $chemist->address) }}"  :label="__('Address')" :messages="$errors->get('address')"/>  
                </div>
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>                    
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('chemists.index')">
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
            var options = {
                searchable: true
            };
            NiceSelect.bind(document.getElementById("employee_id"), options);
            NiceSelect.bind(document.getElementById("territory_id"), options);
        },
    }));
});
</script>
</x-layout.default>
