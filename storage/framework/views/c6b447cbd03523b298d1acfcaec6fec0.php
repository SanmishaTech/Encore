<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.default','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.default'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    

    <div x-data="contacts">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="text-xl">Contacts</h2>
            <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                <div class="flex gap-3">
                    <div>
                        <button type="button" class="btn btn-primary" @click="editUser">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                                <circle cx="10" cy="6" r="4" stroke="currentColor"
                                    stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M18 17.5C18 19.9853 18 22 10 22C2 22 2 19.9853 2 17.5C2 15.0147 5.58172 13 10 13C14.4183 13 18 15.0147 18 17.5Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M21 10H19M19 10H17M19 10L19 8M19 10L19 12" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            Add Contact
                        </button>
                        <div class="fixed inset-0 bg-[black]/60 z-[999] overflow-y-auto hidden"
                            :class="addContactModal && '!block'">
                            <div class="flex items-center justify-center min-h-screen px-4"
                                @click.self="addContactModal = false">
                                <div x-show="addContactModal" x-transition x-transition.duration.300
                                    class="panel border-0 p-0 rounded-lg overflow-hidden md:w-full max-w-lg w-[90%] my-8">
                                    <button type="button"
                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-white-dark hover:text-dark"
                                        @click="addContactModal = false">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                    <h3 class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]"
                                        x-text="params.id ? 'Edit Contact' : 'Add Contact'"></h3>
                                    <div class="p-5">
                                        <form method="POST" x-bind:action="`student/update`">
                                        <?php echo csrf_field(); ?>   
                                            <div class="mb-5">
                                                <label for="name">Name</label>
                                                <input  type="hidden" name="id"
                                                   x-model="params.id" />
                                                <input id="name" type="text" name="name" placeholder="Enter Name"
                                                    class="form-input" x-model="params.name" />
                                            </div>
                                            <div class="mb-5">
                                                <label for="email">Email</label>
                                                <input id="email" type="email" name="email" placeholder="Enter Email"
                                                    class="form-input" x-model="params.email" />
                                            </div>
                                            <div class="mb-5">
                                                <label for="number">Phone Number</label>
                                                <input id="number" type="text" name="mobile" placeholder="Enter Phone Number"
                                                    class="form-input" x-model="params.mobile" />
                                            </div>
                                            <div class="mb-5">
                                                <label for="occupation">Gender</label>
                                                <input id="occupation" type="text" name="gender" placeholder="Enter Gender"
                                                    class="form-input" x-model="params.gender" />
                                            </div>
                                            <div class="mb-5">
                                                <label for="address">Address</label>
                                                <textarea id="address" name="address" rows="3" placeholder="Enter Address" class="form-textarea resize-none min-h-[130px]"
                                                    x-model="params.address"></textarea>
                                            </div>
                                            <div class="flex justify-end items-center mt-8">
                                                <button type="button" class="btn btn-outline-danger"
                                                    @click="addContactModal = false">Cancel</button>
                                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4"
                                                    x-text="params.id ? 'Update' : 'Add'"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>

                <div class="relative ">
                    <input type="text" placeholder="Search Contacts"
                        class="form-input py-2 ltr:pr-11 rtl:pl-11 peer" x-model="searchUser"
                        @keyup="searchContacts" />
                    <div
                        class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">

                        <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor"
                                stroke-width="1.5" opacity="0.5"></circle>
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 panel p-0 border-0 overflow-hidden">
            <template x-if="displayType === 'list'">
                <div class="table-responsive">
                    <table class="table-striped table-hover">
                        <thead>
                            <tr>
                                <th @click="sort('name')">Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th class="!text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="contact in filterdContactsList" :key="contact.id">
                                <tr>
                                    <td>
                                        <div class="flex items-center w-max">
                                            <div x-show="contact.path" class="w-max">
                                                <img :src="`/assets/images/${contact.path}`"
                                                    class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"
                                                    alt="avatar" />
                                            </div>
                                            <div x-show="!contact.path && contact.name"
                                                class="grid place-content-center h-8 w-8 ltr:mr-2 rtl:ml-2 rounded-full bg-primary text-white text-sm font-semibold"
                                                x-text="contact.name.charAt(0) + '' + contact.name.charAt(contact.name.indexOf(' ') + 1)">
                                            </div>
                                            <div x-show="!contact.path && !contact.name"
                                                class="border border-gray-300 dark:border-gray-800 rounded-full p-2 ltr:mr-2 rtl:ml-2">

                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4.5 h-4.5">
                                                    <circle cx="12" cy="6" r="4"
                                                        stroke="currentColor" stroke-width="1.5"></circle>
                                                    <ellipse opacity="0.5" cx="12" cy="17"
                                                        rx="7" ry="4" stroke="currentColor"
                                                        stroke-width="1.5"></ellipse>
                                                </svg>
                                            </div>
                                            <div x-text="contact.name"></div>
                                        </div>
                                    </td>
                                    <td x-text="contact.email"></td>
                                    <td x-text="contact.mobile" class="whitespace-nowrap"></td>
                                    <td x-text="contact.address" class="whitespace-nowrap"></td>
                                    <td x-text="contact.gender" class="whitespace-nowrap"></td>
                                    <td>
                                        <div class="flex gap-4 items-center justify-center">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                @click="editUser(contact)">Edit</button>
                                            
                                            <form x-bind:action="`student/delete/${contact.id}`" method="Post" onsubmit="return confirm('Do you really want to Delete this Record')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                           
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </template>
        </div>      
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("contacts", () => ({
                defaultParams: {
                    id: null,
                    name: '',
                    email: '',
                    role: '',
                    phone: '',
                    location: ''
                },
                displayType: 'list',
                addContactModal: false,
                params: {
                    id: null,
                    name: '',
                    email: '',
                    role: '',
                    phone: '',
                    location: ''
                },
                filterdContactsList: [],
                searchUser: '',
                sortCol:null,
                sortAsc:false,
                contactList: [
                    <?php if(!empty($students)): ?>
                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        id: <?php echo e($student->id); ?>,
                        path: 'profile-35.png',
                        name: '<?php echo e($student->name); ?>',
                        email: '<?php echo e($student->email); ?>',
                        mobile: '<?php echo e($student->mobile); ?>',
                        address: '<?php echo e($student->address); ?>',
                        gender: '<?php echo e($student->gender); ?>',
                    },
                   
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  
                ],

                init() {
                    this.searchContacts();
                },

                searchContacts() {
                    this.filterdContactsList = this.contactList.filter((d) => d.name.toLowerCase()
                        .includes(this.searchUser.toLowerCase()));
                },

                editUser(user) {
                    this.params = this.defaultParams;
                    if (user) {
                        this.params = JSON.parse(JSON.stringify(user));
                    }

                    this.addContactModal = true;
                },

                saveUser() {
                    if (!this.params.name) {
                        this.showMessage('Name is required.', 'error');
                        return true;
                    }
                    if (!this.params.email) {
                        this.showMessage('Email is required.', 'error');
                        return true;
                    }
                    if (!this.params.phone) {
                        this.showMessage('Phone is required.', 'error');
                        return true;
                    }
                    if (!this.params.role) {
                        this.showMessage('Occupation is required.', 'error');
                        return true;
                    }

                    if (this.params.id) {
                        //update user
                        let user = this.contactList.find((d) => d.id === this.params.id);
                        user.name = this.params.name;
                        user.email = this.params.email;
                        user.role = this.params.role;
                        user.phone = this.params.phone;
                        user.location = this.params.location;
                    } else {
                        //add user
                        let maxUserId = this.contactList.length ? this.contactList.reduce((max,
                                character) => (character.id > max ? character.id : max), this
                            .contactList[0].id) : 0;

                        let user = {
                            id: maxUserId + 1,
                            path: 'profile-35.png',
                            name: this.params.name,
                            email: this.params.email,
                            role: this.params.role,
                            phone: this.params.phone,
                            location: this.params.location,
                            posts: 20,
                            followers: '5K',
                            following: 500,
                        };
                        this.contactList.splice(0, 0, user);
                        this.searchContacts();
                    }

                    this.showMessage('User has been saved successfully.');
                    this.addContactModal = false;
                },

                deleteUser(user) {
                    this.contactList = this.contactList.filter((d) => d.id != user.id);
                    this.searchContacts();
                    this.showMessage('User has been deleted successfully.');
                },

               

                showMessage(msg = '', type = 'success') {
                    const toast = window.Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    toast.fire({
                        icon: type,
                        title: msg,
                        padding: '10px 20px',
                    });
                },
                sort(col) {
                    if(this.sortCol === col) this.sortAsc = !this.sortAsc;
                    this.sortCol = col;
                    this.cats.sort((a, b) => {
                        if(a[this.sortCol] < b[this.sortCol]) return this.sortAsc?1:-1;
                        if(a[this.sortCol] > b[this.sortCol]) return this.sortAsc?-1:1;
                        return 0;
                    });
                },
            }));
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH /home/sanmisha/@Projects/starterkit/resources/views/user/add.blade.php ENDPATH**/ ?>