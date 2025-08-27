<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'theme' => null,
    'readyToLoad' => false,
    'items' => null,
    'lazy' => false,
    'tableName' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'theme' => null,
    'readyToLoad' => false,
    'items' => null,
    'lazy' => false,
    'tableName' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<div <?php if(isset($this->setUp['responsive'])): ?> x-data="pgResponsive" <?php endif; ?>>
    <table
        id="table_base_<?php echo e($tableName); ?>"
        class="table power-grid-table <?php echo e(data_get($theme, 'table.tableClass')); ?>"
        style="<?php echo e(data_get($theme, 'tableStyle')); ?>"
    >
        <thead
            class="<?php echo e(data_get($theme, 'table.theadClass')); ?>"
            style="<?php echo e(data_get($theme, 'table.theadStyle')); ?>"
        >
            <?php echo e($header); ?>

        </thead>
        <!--[if BLOCK]><![endif]--><?php if($readyToLoad): ?>
            <tbody
                class="<?php echo e(data_get($theme, 'table.tbodyClass')); ?>"
                style="<?php echo e(data_get($theme, 'table.tbodyStyle')); ?>"
            >
                <?php echo e($body); ?>

            </tbody>
        <?php else: ?>
            <tbody
                class="<?php echo e(data_get($theme, 'table.tbodyClass')); ?>"
                style="<?php echo e(data_get($theme, 'table.tbodyStyle')); ?>"
            >
                <?php echo e($loading); ?>

            </tbody>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </table>

    
    <!--[if BLOCK]><![endif]--><?php if($this->canLoadMore && $lazy): ?>
        <div class="justify-center items-center" wire:loading.class="flex" wire:target="loadMore">
            <?php echo $__env->make(powerGridThemeRoot() . '.header.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div x-data="pgLoadMore"></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /var/www/html/jkhomestay/vendor/power-components/livewire-powergrid/src/Providers/../../resources/views/components/table-base.blade.php ENDPATH**/ ?>