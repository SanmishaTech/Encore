<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('territories.index') }}" class="text-primary hover:underline">Territories</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5">        
        <form class="space-y-5" action="{{ route('territories.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Territory</h5>
                </div>               
                <div class="grid grid-cols-3 gap-4 mb-4">      
                    <div>
                        <label>Name: <span style="color: red">*</span></label>
                        <x-text-input class="form-input" name="name" value="{{ old('name') }}"/>                       
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />                       
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>                    
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('territories.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>
            </div>            
        </form>         
    </div>
</div> 
</x-layout.default>
