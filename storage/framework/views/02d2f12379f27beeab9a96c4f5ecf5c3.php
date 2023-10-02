<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['link', 'text'=>'Followup']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['link', 'text'=>'Followup']); ?>
<?php foreach (array_filter((['link', 'text'=>'Followup']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="lead" style="display:inline-block;">
    <a href="<?php echo e($link); ?>">
        <span class="badge bg-info rounded-full"> 
            <?php echo e($text); ?>

        </span>
    </a>
</div>

<?php /**PATH C:\Users\HP\Project\TeamPulse\resources\views/components/followup-button.blade.php ENDPATH**/ ?>