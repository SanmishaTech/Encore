<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.default','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.default'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="<?php echo e(route('students.index')); ?>" class="text-primary hover:underline">Students</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Create</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Add Students</h5>
            </div>
            <form class="space-y-5" action="<?php echo e(route('students.store')); ?>" method="POST">
             <?php echo csrf_field(); ?>
                <div class="panel">
                    <div class=" grid grid-cols-3 gap-4">               
                        <div>
                            <label >Name:</label>
                            <input type="text" placeholder="Enter Name" class="form-input" name="name" required autofocus />
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label >Email:</label>
                            <input type="email" placeholder="Enter Email" class="form-input" name="email" required autofocus />
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label >Mobile:</label>
                            <input type="text" placeholder="Enter Mobile" class="form-input" name="mobile" required autofocus />
                            <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>      
                        <div >
                            <label for="actionRole">Gender:</label>
                            <select class="selectize  <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="gender">
                                <option selected disabled>Select </option>
                                <option value='Female'>Female</option>
                                <option value='Male'>Male</option>
                                
                            </select>
                            
                            <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>               
                        <div>
                            <label >D.O.B:</label>
                            <input type="date" placeholder="Enter Date" class="form-input" name="dob" required autofocus />
                            <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>                
                        
                    
                    </div>
                    <div class="  grid grid-cols-1">   
                        <div>
                            <label >Address:</label>
                            <input type="text" placeholder="Enter Address" class="form-input" name="address" required autofocus />
                            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>    
                        
                    </div>
                </div>
                <div class="panel table-responsive">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light"> Students Details</h5>
                    </div>

                    <div x-data="StudentDetails">
                        <div class="flex xl:flex-row flex-col gap-2.5">
                            <div class="panel px-0 flex-1 py-6 ltr:xl:mr-6 rtl:xl:ml-6">
                            
                                <hr class="border-[#e0e6ed] dark:border-[#1b2e4b] my-6">
                            
                                <div class="mt-8">
                                    <template x-if="studentDetails">
                                        <div class="table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Contact</th>
                                                        <th>Subject</th>
                                                        <th class="w-1">Marks</th>
                                                        <th class="w-1">Grade</th>
                                                        <th class="w-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <template x-if="studentDetails.length <= 0">
                                                        <tr>
                                                            <td colspan="5" class="!text-center font-semibold">No Item Available
                                                            </td>
                                                        </tr>
                                                    </template>
                                                    <template x-for="(studentDetail, i) in studentDetails" :key="i">
                                                        <tr class="align-top border-b border-[#e0e6ed] dark:border-[#1b2e4b]">
                                                            <td>
                                                                <select x-model="studentDetail.contact_id" class="selectize  <?php $__errorArgs = ['contact_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="contact_id" x-bind:name="`student_details[${studentDetail.id}][contact_id]`" @change="show()">
                                                                    <option selected disabled>Select </option>
                                                                    <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value='<?php echo e($contact->id); ?>'><?php echo e($contact->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    
                                                                </select>
                                                            </td>
                                                            <td>
                                                               
                                                                <input type="text" class="form-input min-w-[200px]"
                                                                    placeholder="Enter Item Name" x-model="studentDetail.subject" x-bind:name="`student_details[${studentDetail.id}][subject]`"/>
                                                            </td>
                                                                <td><input type="text" class="form-input w-32" placeholder="Marks"  x-bind:name="`student_details[${studentDetail.id}][marks]`"
                                                                    x-model="studentDetail.marks"  /></td>
                                                            <td><input type="text" class="form-input w-32" placeholder="Grade" x-bind:name="`student_details[${studentDetail.id}][grade]`"
                                                                    x-model="studentDetail.grade" /></td>
                                                            <td>
                                                                <button type="button" @click="removeItem(studentDetail)">

                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                        height="24px" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="w-5 h-5">
                                                                        <line x1="18" y1="6" x2="6"
                                                                            y2="18"></line>
                                                                        <line x1="6" y1="6" x2="18"
                                                                            y2="18"></line>
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </div>
                                    </template>
                                    <div class="flex justify-between sm:flex-row flex-col mt-6 px-4">
                                        <div class="sm:mb-0 mb-6">
                                            <button type="button" class="btn btn-primary" @click="addItem()">Add Item</button>
                                        </div>                                    
                                    </div>

                                   
                                </div>
                                
                            </div>
                        
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary !mt-6">Submit</button>
             </form> 

           
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data('StudentDetails', () => ({
                studentDetails: [],
                               
                

                addItem() {
                    let maxId = 0;
                    if (this.studentDetails && this.studentDetails.length) {
                        maxId = this.studentDetails.reduce((max, character) => (character.id > max ? character
                            .id : max), this.studentDetails[0].id);
                    }
                    this.studentDetails.push({
                        id: maxId + 1,
                        contact_id: '',
                        subject: '',
                        marks: 0,
                        grade: '',
                    });
                },
              
                async show() {
                    this.result = await (await fetch('/contacts/'+this.studentDetail.contact_id, {
                    method: 'GET',
                    headers: {
                        'Content-type': 'application/json;',
                    },
                    })).json();
                    this.studentDetail.subject = this.result.name;

                    console.log(this.result.name);
                },

                removeItem(studentDetail) {
                    this.studentDetails = this.studentDetails.filter((d) => d.id != studentDetail.id);
                }
            }));
        });
    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH C:\@Projects\starterkit\resources\views/students/create.blade.php ENDPATH**/ ?>