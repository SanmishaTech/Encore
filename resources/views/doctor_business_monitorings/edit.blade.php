<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('doctor_business_monitorings.index') }}" class="text-primary hover:underline">DBM</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('doctor_business_monitorings.update', ['doctor_business_monitoring' => $doctor_business_monitoring->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit DBM</h5>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>GAF Code :<span style="color: red">*</span></label>
                        <select class="form-input" name="code">
                            <option>Select Code</option>
                            @foreach ($gaf_code as $id => $code)
                                <option value="{{$id}}" {{ $doctor_business_monitoring->code ? ($doctor_business_monitoring->code == $id ? 'Selected' : '' ) : ''}}>{{ $code }}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('code')" class="mt-2" /> 
                    </div>
                    <div>
                        <label>ME HQ :</label>
                        <select class="form-input" name="employee_id_1" >
                            <option>Select MEHQ</option>
                            @foreach ($employees as $id => $employee)
                                <option value="{{$id}}" {{ $doctor_business_monitoring->employee_id_1 ? ($doctor_business_monitoring->employee_id_1 == $id ? 'Selected' : '' ) : ''}}>{{ $code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>ABM :</label>
                        <select class="form-input" name="employee_id_2" readonly="true"  x-model="employee_id_2">
                            <option>Select ABM</option>
                            <option key="area.id" :value="area.id" x-text="area.name" ></option>
                        </select>
                    </div>
                    <div>
                        <label>RBM/ZBM :</label>
                        <select class="form-input" name="employee_id_3" readonly="true"  x-model="employee_id_3">
                            <option>Select RBM/ZBM</option>
                            <option key="zone.id" :value="zone.id" x-text="zone.name" ></option>
                        </select> 
                    </div> 
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label>Doctor:</label>
                        <select class="form-input" name="doctor_id" readonly="true">
                            <option>Select Doctor</option>
                           
                        </select> 
                    </div>  
                    <x-text-input name="mpl_no" value="{{ old('mpl_no', $doctor_business_monitoring->mpl_no) }}" :label="__('MPL NO')"  :messages="$errors->get('mpl_no')"/>
                    <x-text-input name="speciality" value="{{ old('speciality', $doctor_business_monitoring->speciality) }}" :label="__('Speciality')"  :messages="$errors->get('speciality')"/>
                    <x-text-input name="location" value="{{ old('location',$doctor_business_monitoring->location) }}" :label="__('Location')"  :messages="$errors->get('location')"/>
                </div> 
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-text-input name="date" id="date" value="{{ old('date', $doctor_business_monitoring->date) }}" :label="__('Date')"  :messages="$errors->get('date')"/>
                    <x-text-input name="month" value="{{ old('month', $doctor_business_monitoring->month) }}" id="month" :label="__('Proposal Month')"  :messages="$errors->get('month')"/>      
                    <x-combo-input name="amount" value="{{ old('amount', $doctor_business_monitoring->amount) }}" :label="__('Amount')"  :messages="$errors->get('amount')"/>
                    <x-text-input name="roi" value="{{ old('roi', $doctor_business_monitoring->roi) }}" :label="__('ROI')"  :messages="$errors->get('roi')"/>
                </div>               
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('doctor_business_monitorings.index')">
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

            flatpickr(document.getElementById('month'), {
                dateFormat: 'M',
            });
        }, 
    }));
});
</script> 
</x-layout.default>
