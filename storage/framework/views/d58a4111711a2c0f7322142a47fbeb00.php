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
                <a href="<?php echo e(route('roles.index')); ?>" class="text-primary hover:underline">Roles</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Account Settings</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Roles</h5>
                </div>
                <form class="space-y-5" action="<?php echo e(route('roles.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="actionName">Name:</label>
                        <input id="actionName" type="text" placeholder="Enter name" class="form-input" name="name" required autofocus autocomplete="name"/>
                    </div>
                    <div>
                        <label for="actionGuardName">Guard Name:</label>                        
                        <select name="guard_name" id="actionGuardName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 required">
                            <option selected>Select Guard name</option>                            
                            <option value="web">Web</option>
                            <option value="api">API</option>
                        </select>
                    </div>
                    <!-- <div>
                        <label for="actionPermission" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission:</label>
                        <select name="permission_id" id="actionPermission" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required  autofocus>
                            <option selected>Select Permission</option>                            
                            <?php if(isset($permissions)): ?>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div> -->
                    <div>
                        <ul>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li style="width:19%;display: inline-block;">
                                <label class="inline-flex">                            
                                <!-- <input type="checkbox" name="permission_id" value="<?php echo e($permission->id); ?>" class="form-checkbox outline-info" id="permission"> -->
                                <input type="checkbox" name="permission[<?php echo e($permission->name); ?>]" value="<?php echo e($permission->name); ?>" class="form-checkbox outline-info permission">
                                <?php echo e($permission->name); ?>

                            </label>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                </form>
            </div>
        </div>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?><?php /**PATH C:\@Projects\starterkit\resources\views/roles/create.blade.php ENDPATH**/ ?>