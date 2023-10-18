<x-layout.default>   
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('grant_approvals.index') }}" class="text-primary hover:underline">Grant Approval</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Report</span>
        </li>
    </ul>     
    <div class="pt-5">
        <form action="{{ route('reportPDF')  }}" method="POST" target="_blank">
            @csrf
            <div class="panel" x-data="data">
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-text-input name="from_date" value="{{ old('from_date') }}" id="from_date" :label="__('From Date')"  :messages="$errors->get('from_date')" />                    
                    <x-text-input name="to_date" value="{{ old('to_date') }}" id="to_date" :label="__('To Date')"  :messages="$errors->get('to_date')" />                
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