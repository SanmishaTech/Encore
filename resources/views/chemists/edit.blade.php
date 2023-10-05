<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('chemists.index') }}" class="text-primary hover:underline">Chemists</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5">        
        <form class="space-y-5" action="{{ route('chemists.update', ['chemist'=>$chemist->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Chemist</h5>
                </div>               
                <div class="grid grid-cols-4 gap-4 mb-4">      
                    <div>
                        <label>Chemist Name:<span style="color: red">*</span></label>
                        <x-text-input class="form-input" name="chemist" value="{{ old('chemist') ? old('chemist') : $chemist->chemist }}"/>                       
                        <x-input-error :messages="$errors->get('chemist')" class="mt-2" />                       
                    </div>
                    <div>
                        <label>Class:</label>
                        <x-text-input class="form-input" name="class" value="{{ old('class') ? old('class') : $chemist->class }}"/>                       
                        <x-input-error :messages="$errors->get('class')" class="mt-2" />                       
                    </div>
                    <div>
                        <label>Employee :</label>
                        <select class="form-input" name="employee_id">
                            <option>Select Employee Code</option>
                            @foreach ($employees as $id=>$employee)                                
                                <option value="{{$id}}" {{ $chemist->employee_id ? ($chemist->employee_id == $id ? 'Selected' : '' ) : ''}}>{{$employee}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" /> 
                    </div>
                    <div>
                        <label>Territory :</label>
                        <select class="form-input" name="territory_id">
                            <option>Select Territory</option>
                            @foreach ($territories as $id=>$territory)                                
                                <option value="{{$id}}" {{ $chemist->territory_id ? ($chemist->territory_id == $id ? 'Selected' : '' ) : ''}} >{{$territory}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('territory_id')" class="mt-2" /> 
                    </div>

                </div>
               
                <div class="grid grid-cols-4 gap-4 mb-4">      
                    <div>
                        <label>Contact No 1:</label>
                        <x-text-input class="form-input" name="contact_no_1" value="{{ old('contact_no_1') ? old('contact_no_1') : $chemist->contact_no_1 }}"/>                       
                        <x-input-error :messages="$errors->get('contact_no_1')" class="mt-2" />                       
                    </div>
                    <div>
                        <label>Contact No 2:</label>
                        <x-text-input class="form-input" name="contact_no_2"  value="{{ old('contact_no_2') ? old('contact_no_2') : $chemist->contact_no_2 }}"/>                       
                        <x-input-error :messages="$errors->get('contact_no_2')" class="mt-2" />                       
                    </div>
                    <div>
                        <label>Email:</label>
                        <x-text-input class="form-input" name="email" value="{{ old('email') ? old('email') : $chemist->email }}"/>                       
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />                       
                    </div>
                    <div>
                        <label>Contact Person:</label>
                        <x-text-input class="form-input" name="contact_person" value="{{ old('contact_person') ? old('contact_person') : $chemist->contact_person }}"/>                       
                        <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />                       
                    </div>


                </div>
                <div class="grid grid-cols-1 gap-4 mb-4">     
                  
                  <div>
                      <label>Address:</label>
                      <x-text-input class="form-input" name="address" value="{{ old('address') ? old('address') : $chemist->address }}"/>                       
                      <x-input-error :messages="$errors->get('address')" class="mt-2" />                       
                  </div>
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
</x-layout.default>
