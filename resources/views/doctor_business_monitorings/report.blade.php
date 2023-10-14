<x-layout.default>        
    <div class="pt-5">
        <form action="{{ route('reportCDBM')  }}" method="POST" target="_blank">
            @csrf
            <div class="panel" x-data="data">
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-text-input name="from_date" id="from_date" :label="__('From Date')"  :messages="$errors->get('date_of_issue')"/>                    
                    <x-text-input name="to_date" id="to_date" :label="__('To Date')"  :messages="$errors->get('date_of_issue')"/>                
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