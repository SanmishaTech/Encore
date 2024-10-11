<x-layout.default>
    @role(['Admin','Marketing Executive'])
        <x-add-button :link="route('grant_approvals.create')" />
    @endrole
    <br><br>
    <div x-data="form">
        <div class="panel">
            {{-- <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Grant Approvals</h5>
            </div> --}}

            {{-- <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Grant Approvals</h5>
                <div class="flex items-center gap-4">
                    <form action="{{ route('grant_approvals.search') }}" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
                <div class="flex items-center">
                    <form action="{{ route('grant_approvals.searchStatus') }}" method="get" class="flex items-center">
                        <input type="text" name="status" placeholder="search status" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
            </div> --}}
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Grant Approvals</h5>
                <div class="flex items-center gap-4"> <!-- Added gap-4 for spacing -->
                    <form action="{{ route('grant_approvals.search') }}" method="get" class="flex items-center">
                        <select name="status" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                            <option value="">Status</option>
                            <option value="Open" {{ request()->get('status') == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="Level 1 Approved" {{ request()->get('status') == 'Level 1 Approved' ? 'selected' : '' }} >Level 1 Approved</option>
                            <option value="Level 2 Approved" {{ request()->get('status') == 'Level 2 Approved' ? 'selected' : '' }}>Level 2 Approved</option>
                            <option value="Level 1 Rejected" {{ request()->get('status') == 'Level 1 Rejected' ? 'selected' : '' }}>Level 1 Rejected</option>
                            <option value="Level 2 Rejected" {{ request()->get('status') == 'Level 2 Rejected' ? 'selected' : '' }}>Level 2 Rejected</option>
                        </select>
                        <input type="text" name="search" placeholder="search" value="{{ request()->get('search') }}" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Search</button>
                    </form>
                   
                </div>
            </div>
            

            <!-- <form action="{{ route('grant_approvals.index') }}" method="GET" role="search">
                <div class="float-right mr-2">
                    <span>
                        <button class="btn btn-info" type="submit" title="Search projects">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                <circle cx="11.5" cy="11.5" r="9.5"
                                    stroke="currentColor" stroke-width="1.5" opacity="0.5"></circle>
                                <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                            </svg>
                        </button>
                    </span>
                </div>
                <div class="float-right">
                    <input type="text" placeholder="Search" class="form-input" name="search"/>
                </div>
            </form> -->
            <div class="mt-6">
                <div class="table-responsive">
                    {{ $grant_approvals->links() }}
                    <br>
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Marketing Executive</th>
                                <th>Area Manager</th>
                                <th>Zonal Manager</th>
                                <th>Doctor</th>
                                <th>Activity</th>
                                <th>Proposal Amount</th>
                                <th>Approved Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grant_approvals as $grant_approval)
                                <tr>
                                    <td>{{ @$grant_approval->code }}</td>
                                    <td>{{ @$grant_approval->Manager->name }}</td>
                                    <td>{{ @$grant_approval->Manager->AreaManager->name }}</td>
                                    <td>{{ @$grant_approval->Manager->ZonalManager->name }}</td>
                                    <td>{{ @$grant_approval->Doctor->doctor_name }}</td>
                                    <td>{{ @$grant_approval->Activity->name }}</td>
                                    <td class="whitespace-nowrap"> &#8377;  {{ @$grant_approval->proposal_amount }}</td>
                                    <td class="whitespace-nowrap"> &#8377;  {{ $grant_approval->approval_amount }}</td>
                                    <td class="whitespace-nowrap" >
                                        {!! $grant_approval->status == "Open" ? '<span class="badge bg-info"> Open </span>' : ($grant_approval->status == "Level 1 Approved" ? '<span class="badge bg-warning"> Level 1 Approved </span>' : ($grant_approval->status == "Level 2 Approved" ? '<span class="badge bg-success"> Level 2 Approved</span>' :  ($grant_approval->status == "Level 1 Rejected" ? '<span class="badge bg-danger"> Level 1 Rejected </span>' : ($grant_approval->status == "Level 2 Rejected" ? '<span class="badge bg-danger"> Level 2 Rejected</span>' : '')) ))  !!}
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <ul class="flex items-center gap-2" >
                                            @role(['Area Manager'])
                                            @if($grant_approval->status == "Open")
                                                <li style="display: inline-block;vertical-align:top;">
                                                    <a href="/grant_approvals/approval_form/{{$grant_approval->id }}" class="btn btn-success btn-sm">Approval</a>
                                                </li>

                                                <li style="display: inline-block;vertical-align:top;">
                                                    {{-- <a href="/grant_approvals/rejected/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Rejected</a> --}}
                                                    <a href="/grant_approvals/reject_form/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Rejected</a>

                                                </li>
                                            @endif
                                            @endrole

                                            @role(['Zonal Manager'])
                                                @if($grant_approval->status == "Open" || $grant_approval->status == "Level 1 Approved")
                                                <li style="display: inline-block;vertical-align:top;">
                                                    <a href="/grant_approvals/approval_form/{{$grant_approval->id }}" class="btn btn-success btn-sm">Approval</a>
                                                </li>
                                                <!-- <li style="display: inline-block;vertical-align:top;">
                                                    <a href="#" class="btn btn-success btn-sm"  @click="toggle({{$grant_approval->id }})">Approval</a>
                                                </li> -->
                                                <li style="display: inline-block;vertical-align:top;">
                                                    <a href="/grant_approvals/reject_form/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                                </li>
                                                @endif
                                            @endrole
                                            @role(['Admin'])
                                                <li style="display: inline-block;vertical-align:top;">
                                                    <a href="#" class="btn btn-success btn-sm"  @click="toggle({{$grant_approval->id }})">Approval</a>
                                                </li>
                                                    <li style="display: inline-block;vertical-align:top;">
                                                        <a href="/grant_approvals/reject_form/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                                    </li>
                                            @endrole
                                            {{--  --}}
                                            @role(['Area Manager', 'Marketing Executive'])
                                            @if($grant_approval->approval_level_1 == false)
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-edit-button :link=" route('grant_approvals.edit', ['grant_approval'=> $grant_approval->id])" />
                                            </li>
                                            @endif
                                            @endrole
                                            @role(['Zonal Manager'])
                                                @if($grant_approval->approval_level_2 == false)
                                                <li style="display: inline-block;vertical-align:top;">
                                                    <x-edit-button :link=" route('grant_approvals.edit', ['grant_approval'=> $grant_approval->id])" />
                                                </li>
                                                @endif
                                            @endrole
                                            @role(['Admin'])
                                                @if($grant_approval->status == "Open")
                                                <li style="display: inline-block;vertical-align:top;">
                                                    <x-edit-button :link=" route('grant_approvals.edit', ['grant_approval'=> $grant_approval->id])" />
                                                </li>
                                                @endif
                                            @endrole
                                            @role(['Admin'])
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-delete-button :link=" route('grant_approvals.destroy', ['grant_approval'=> $grant_approval->id] )" />
                                            </li>
                                            @endrole
                                            @role(['Root'])
                                            {{-- @if($grant_approval->status == "Open") --}}
                                            <li style="display: inline-block;vertical-align:top;">
                                                <x-edit-button :link=" route('grant_approvals.edit', ['grant_approval'=> $grant_approval->id])" />
                                            </li>
                                            {{-- @endif --}}
                                        @endrole
                                        </ul>
                                    </td>
                                    <td>{{ @$grant_approval->remark }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $grant_approvals->links() }}
                </div>
            </div>
        </div>
        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
            :class="open && '!block'">
            <div class="flex items-start justify-center min-h-screen px-4"
                @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300
                    class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm my-8">
                    <div
                        class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">
                        Approval
                        <button type="button" @click="toggle"
                            class="text-white-dark hover:text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                height="24px" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="w-6 h-6">
                                <line x1="18" y1="6" x2="6"
                                    y2="18"></line>
                                <line x1="6" y1="6" x2="18"
                                    y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="p-5">
                        <form class="space-y-5" action="" method="POST">
                        @csrf
                            <div class="relative mb-4">
                            <x-text-input name="id" x-model="id"  :messages="$errors->get('code')" hidden/>
                                <x-combo-input name="amount"  :label="__('Approval Amount')"  :messages="$errors->get('amount')"/>
                            </div>
                            <x-success-button>
                                {{ __('Submit') }}
                            </x-success-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                id: null,
                open: false,

                init() {
                    this.open= false;
                },

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
                },

                toggle(x) {
                    console.log(x);
                    this.id = x;
                    this.open = !this.open;
                },
            }));
        });
    </script>
</x-layout.default>
