<x-layout.default>   
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('doctor_business_monitorings.index') }}" class="text-primary hover:underline">CDBM</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Report</span>
        </li>
    </ul>      
    <div class="pt-5">
        <form action="{{ route('reportCDBM')  }}" method="POST">
            @csrf
            <div class="panel" x-data="data">
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-text-input name="from_date" id="from_date" value="{{ old('from_date') }}" :label="__('From Date')"  :messages="$errors->get('from_date')"/>                    
                    <x-text-input name="to_date" id="to_date" value="{{ old('to_date') }}" :label="__('To Date')"  :messages="$errors->get('to_date')"/> 
                            <div class="flex-1">
                                <label for="doctor" class="block text-sm font-medium text-gray-700">Doctor</label>
                                <select name="doctor" id="doctor" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <option value="">Select Doctor</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" @if(old('doctor') == $doctor->doctor_name) selected @endif>{{ $doctor->doctor_name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor')
                                    <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            @role(['Admin', 'Root'])
                            <div class="flex-1">
                                <label for="zonalManager" class="block text-sm font-medium text-gray-700">Zonal Manager</label>
                                <select name="zonalManager" id="zonalManager" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <option value="">Select Zonal Manager</option>
                                    @foreach($zonalManagers as $zonalManager)
                                        <option value="{{ $zonalManager->id }}" @if(old('zonalManager') == $zonalManager->name) selected @endif>{{ $zonalManager->name }}</option>
                                    @endforeach
                                </select>
                                @error('zonalManager')
                                    <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            @endrole
                </div>
                {{-- <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="doctor" class="block text-sm font-medium text-gray-700">Doctor</label>
                        <select name="doctor" id="doctor" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @if(old('doctor') == $doctor->doctor_name) selected @endif>{{ $doctor->doctor_name }}</option>
                            @endforeach
                        </select>
                        @error('doctor')
                            <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    @role(['Admin', 'Root'])
                    <div class="flex-1">
                        <label for="zonalManager" class="block text-sm font-medium text-gray-700">Zonal Manager</label>
                        <select name="zonalManager" id="zonalManager" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <option value="">Select Zonal Manager</option>
                            @foreach($zonalManagers as $zonalManager)
                                <option value="{{ $zonalManager->id }}" @if(old('zonalManager') == $zonalManager->name) selected @endif>{{ $zonalManager->name }}</option>
                            @endforeach
                        </select>
                        @error('zonalManager')
                            <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    @endrole
                </div> --}}
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
</x-layout.default>
<script>
document.addEventListener("alpine:init", () => {
    Alpine.data('data', () => ({   
        init() {
            flatpickr(document.getElementById('from_date'), {
                dateFormat: 'Y-m-d',
            });
            
            flatpickr(document.getElementById('to_date'), {
                dateFormat: 'Y-m-d',
            });
        },           
    }));
});
</script>