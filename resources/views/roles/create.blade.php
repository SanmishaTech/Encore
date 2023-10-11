<x-layout.default>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route('roles.index') }}" class="text-primary hover:underline">Roles</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Add</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Roles</h5>
                </div>
                <form class="space-y-5" action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2"> 
                        <x-text-input name="name" value="{{ old('name') }}" :label="__('Name')" :require="true" :messages="$errors->get('name')"/> 
                        <div>
                            <label for="actionGuardName">Guard Name:<span style="color: red">*</span></label>                        
                            <select name="guard_name" id="actionGuardName" class="form-input">
                                <option selected disabled>Select Guard name</option>                            
                                <option value="web">Web</option>
                                <option value="api">API</option>
                            </select>
                            @if($errors->default->first('guard_name'))
                            <p class="text-danger mt-1">Please select Guard name</p>
                            @endif
                        </div> 
                    </div>                  
                    <div>
                        <ul>
                            @foreach($permissions as $permission)
                            <li style="width:19%;display: inline-block;">
                                <label class="inline-flex">     
                                <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class="form-checkbox outline-info permission">
                                {{ $permission->name }}
                            </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('roles.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.default>
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {
                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }
            });
        });
    </script>
@endsection