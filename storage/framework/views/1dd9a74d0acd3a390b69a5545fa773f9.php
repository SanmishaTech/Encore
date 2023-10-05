<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['disabled' => false, 'value', 'require' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['disabled' => false, 'value', 'require' => false]); ?>
<?php foreach (array_filter((['disabled' => false, 'value', 'require' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<label <?php echo e($attributes->merge(['class' => 'text-gray-900'])); ?>>
    <?php echo e($value ?? $slot); ?>: 
    <?php if($require): ?>
    <span style="color: red">*</span>
    <?php endif; ?>
</label>
<input <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo $attributes->merge(['class' => 'form-input border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']); ?>>


<?php /**PATH /home/sanmisha/@Projects/Encore/resources/views/components/text-inputs.blade.php ENDPATH**/ ?>