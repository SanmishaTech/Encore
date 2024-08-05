<x-layout.default>
    <x-add-button :link="route('stockists.create')" />
    <x-excel-button :link="route('stockists.import')" />
    <br><br>
    <div x-data="form">
        <div class="panel">
            {{-- <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light" >Stockist</h5> --}}

                <!-- <div class="relative group">
                    <input type="text" placeholder="Search" class="form-input" @change="searchData()" name="search" x-model="stockist_id"/>
                    <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                            <circle cx="11.5" cy="11.5" r="9.5"
                                stroke="currentColor" stroke-width="1.5" opacity="0.5"></circle>
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div> -->
            {{-- </div> --}}
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Stockists</h5>
                <div class="flex items-center">
                    <form action="{{ route('stockists.search') }}" method="get" class="flex items-center">
                        <input type="text" name="search" placeholder="search stockists" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Stockist Name</th>
                                <th>CFA</th>
                                <th>Zonal Manager</th>
                                <th>Area Manager</th>
                                <th>Marketing Executive</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($stockists as $stockist)
                        <tr>
                            <td> {{ $stockist->stockist }}</td>
                            <td> {{ $stockist->cfa_email }}</td>
                            <td>{{ @$stockist->ZonalManager->name }}</td>
                            <td>{{ @$stockist->AreaManager->name }}</td>
                            <td>{{ @$stockist->Manager->name }}</td>
                            <td class="float-right">
                                <ul class="flex items-center gap-2" >
                                    <li style="display: inline-block;vertical-align:top;">
                                        <x-edit-button :link=" route('stockists.edit', $stockist->id)" />
                                    </li>
                                    <li style="display: inline-block;vertical-align:top;">
                                        <x-delete-button :link=" route('stockists.destroy',$stockist->id)" />
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $stockists->links() }}
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
                },


            }));
        });
    </script>
</x-layout.default>
