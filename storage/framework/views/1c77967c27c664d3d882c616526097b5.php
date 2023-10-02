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
            <div class="panel grid grid-cols-1 sm:grid-cols-2 gap-4">                
                <form class="space-y-5" action="<?php echo e(route('roles.update',$role->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>                    
                    <div>
                        <label for="actionName">Name:</label>
                        <input id="actionName" type="text" class="form-input" name="name" value="<?php echo e($role->name); ?>" />
                    </div>                   
                    <div>
                        <label for="actionGuardName">Guard Name:</label>                       
                        <select name="guard_name" id="actionGuardName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Select</option>
                            <option value="web" <?php if($role->guard_name == "web"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Web</option>
                            <option value="api" <?php if($role->guard_name == "api"): ?> <?php echo e('selected'); ?> <?php endif; ?>>API</option>
                        </select>
                    </div>  
                    <div>  
                        <!-- <label for="actionPermission" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permissions:</label>
                        <select name="permission_id" id="actionPermission" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="option_select" disabled selected>Select name</option>
                            <?php if(isset($permissions)): ?>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($permission->id); ?>" <?php echo e($permission->id == $role->permission_id ? 'selected' : ''); ?>><?php echo e($permission->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>   -->
                        <ul>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li style="width:19%;display: inline-block;">
                                <label class="inline-flex">
                                    <input type="checkbox" name="permission[<?php echo e($permission->name); ?>]" value="<?php echo e($permission->name); ?>" class="form-checkbox outline-info permission" <?php echo e(in_array($permission->name, $rolePermissions) ? 'checked' : ''); ?>>
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
<?php $__env->stopSection(); ?><?php /**PATH /home/sanmisha/@Projects/starterkit/resources/views/roles/edit.blade.php ENDPATH**/ ?>