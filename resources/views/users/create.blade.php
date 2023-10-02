<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('users.index') }}" class="text-primary hover:underline">Users</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5">        
        <form class="space-y-5" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add User</h5>
                </div>
                <div class="grid grid-cols-3 gap-4">               
                    <div>
                        <label for="fullname">Full Name :<span style="color: red">*</span></label>
                        <x-text-input id="country" class="form-input" name="name" />                       
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />                        
                    </div>
                    <div>
                        <label for="email">Email :<span style="color: red">*</span></label>
                        <x-email-input class="form-input" id="email" name="email"/> 
                        <x-input-error :messages="$errors->get('email')" class="mt-2" /> 
                    </div>
                    <div>
                        <label for="password">Password :<span style="color: red">*</span></label>
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>                       
                    </div>      
                    <div>
                        <label>Role:</label>
                        <select class="text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-50" name="role">
                            <option selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" 
                                    {{old('role') ? ((old('role') == $role->id) ? 'selected' : '') : '' }}>
                                    {{$role->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>               
                    <div>
                        <label>Active:</label>
                        <select class="text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-50" name="active">
                            <option selected disabled>Select Status</option>
                            <option value='true'>Active</option>
                            <option value='false'>Deactive</option>                           
                        </select>
                    </div> 
                </div>
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('users.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>
            </div>
        </form> 
    </div>
</div> 
</x-layout.default>