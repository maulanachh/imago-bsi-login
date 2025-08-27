<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'theme' => null,
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
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<div>
    <?php
        $responsiveCheckboxColumnName = PowerComponents\LivewirePowerGrid\Responsive::CHECKBOX_COLUMN_NAME;

        $isCheckboxFixedOnResponsive = isset($this->setUp['responsive']) && in_array($responsiveCheckboxColumnName, data_get($this->setUp, 'responsive.fixedColumns')) ? true : false;
    ?>
    <th
        <?php if($isCheckboxFixedOnResponsive): ?> fixed <?php endif; ?>
        scope="col"
        class="<?php echo e(data_get($theme, 'thClass')); ?>"
        style="<?php echo e(data_get($theme, 'thStyle')); ?>"
        wire:key="<?php echo e(md5('checkbox-all')); ?>"
    >
        <div class="<?php echo e(data_get($theme, 'divClass')); ?>">
            <label class="<?php echo e(data_get($theme, 'labelClass')); ?>">
                <input
                    class="<?php echo e(data_get($theme, 'inputClass')); ?>"
                    type="checkbox"
                    wire:click="selectCheckboxAll"
                    wire:model="checkboxAll"
                >
            </label>
        </div>
    </th>
</div>
<?php /**PATH C:\laragon\www\ecommerce\vendor\power-components\livewire-powergrid\src\Providers/../../resources/views/components/checkbox-all.blade.php ENDPATH**/ ?>