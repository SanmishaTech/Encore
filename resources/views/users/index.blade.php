<x-layout.default>
    <x-add-button :link="route('users.create')" />
    <x-excel-button :link="route('users.import')" />
    <br><br>
    <div x-data="form">      
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Users</h5>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>                    
                                <td>{{ ($user->name) }}</td>
                                <td>{{ $user->email }}</td>
                                <td> 
                                    @if(!empty($user->roles))   
                                    @foreach($user->roles as $role)                   
                                    <span class="badge whitespace-nowrap badge bg-info">{{ $role->name }}</span>
                                    @endforeach
                                    @endif
                                </td>
                                @if($user->active == '1')
                                <td><span class="badge badge-outline-success">Active</span></td>
                                @else
                                <td><span class="badge badge-outline-danger">Inactive</span></td>
                                @endif
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('users.edit', $user->id)" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('users.destroy',$user->id)" />  
                                        </li>   
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("form", () => ({
            // highlightjs
            codeArr: [],
            toggleCode(name) {
                if (this.codeArr.includes(name)) {
                    this.codeArr = this.codeArr.filter((d) => d != name);
                } else {
                    this.codeArr.push(name);

                    setTimeout(() => {
                        document.querySelectorAll('pre.code').forEach(el => {
                            hljs.highlightElement(el);
                        });
                    });
                }
            }
        }));
    });
</script>
</x-layout.default>
