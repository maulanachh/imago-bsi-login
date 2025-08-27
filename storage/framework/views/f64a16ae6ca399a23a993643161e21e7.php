<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'loading' => false,
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
    'loading' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<tr class="<?php echo e(data_get($theme, 'table.trClass')); ?>"
    style="<?php echo e(data_get($theme, 'table.trStyle')); ?>"
>
    <!--[if BLOCK]><![endif]--><?php if($loading): ?>
        <td
            class="<?php echo e(data_get($theme, 'table.tdBodyEmptyClass')); ?>"
            colspan="<?php echo e(($checkbox ? 1 : 0) + count($columns)); ?>"
        >
            <!--[if BLOCK]><![endif]--><?php if($loadingComponent): ?>
                <?php echo $__env->make($loadingComponent, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo e(__('Loading')); ?>

            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </td>
    <?php else: ?>
        <!--[if BLOCK]><![endif]--><?php if(data_get($setUp, 'detail.showCollapseIcon')): ?>
            <th
                scope="col"
                class="<?php echo e(data_get($theme, 'table.thClass')); ?>"
                style="<?php echo e(data_get($theme, 'table.trStyle')); ?>"
                wire:key="show-collapse-<?php echo e($tableName); ?>"
            >
            </th>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if(isset($setUp['responsive'])): ?>
            <th
                fixed
                x-show="hasHiddenElements"
                class="<?php echo e(data_get($theme, 'table.thClass')); ?>"
                style="<?php echo e(data_get($theme, 'table.thStyle')); ?>"
            >
            </th>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if($radio): ?>
            <th
                class="<?php echo e(data_get($theme, 'table.thClass')); ?>"
                style="<?php echo e(data_get($theme, 'table.thStyle')); ?>"
            >
            </th>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if($checkbox): ?>
            <?php if (isset($component)) { $__componentOriginal5ad37efae17d48a88ce1ba8e57fbd1d9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5ad37efae17d48a88ce1ba8e57fbd1d9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-powergrid::components.checkbox-all','data' => ['checkbox' => $checkbox,'theme' => data_get($theme, 'checkbox')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-powergrid::checkbox-all'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['checkbox' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($checkbox),'theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(data_get($theme, 'checkbox'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5ad37efae17d48a88ce1ba8e57fbd1d9)): ?>
<?php $attributes = $__attributesOriginal5ad37efae17d48a88ce1ba8e57fbd1d9; ?>
<?php unset($__attributesOriginal5ad37efae17d48a88ce1ba8e57fbd1d9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5ad37efae17d48a88ce1ba8e57fbd1d9)): ?>
<?php $component = $__componentOriginal5ad37efae17d48a88ce1ba8e57fbd1d9; ?>
<?php unset($__componentOriginal5ad37efae17d48a88ce1ba8e57fbd1d9); ?>
<?php endif; ?>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal577dc6db6f201a17d3cae4747c63c7eb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal577dc6db6f201a17d3cae4747c63c7eb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-powergrid::components.cols','data' => ['wire:key' => 'cols-'.e($column->field).' }}','column' => $column,'theme' => $theme,'enabledFilters' => $enabledFilters]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-powergrid::cols'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:key' => 'cols-'.e($column->field).' }}','column' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($column),'theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme),'enabledFilters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($enabledFilters)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal577dc6db6f201a17d3cae4747c63c7eb)): ?>
<?php $attributes = $__attributesOriginal577dc6db6f201a17d3cae4747c63c7eb; ?>
<?php unset($__attributesOriginal577dc6db6f201a17d3cae4747c63c7eb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal577dc6db6f201a17d3cae4747c63c7eb)): ?>
<?php $component = $__componentOriginal577dc6db6f201a17d3cae4747c63c7eb; ?>
<?php unset($__componentOriginal577dc6db6f201a17d3cae4747c63c7eb); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if(isset($actions) && count($actions)): ?>
            <?php
                $responsiveActionsColumnName = PowerComponents\LivewirePowerGrid\Responsive::ACTIONS_COLUMN_NAME;

                $isActionFixedOnResponsive = isset($this->setUp['responsive']) && in_array($responsiveActionsColumnName, data_get($this->setUp, 'responsive.fixedColumns')) ? true : false;
            ?>

            <th
                <?php if($isActionFixedOnResponsive): ?> fixed <?php endif; ?>
                class="<?php echo e(data_get($theme, 'table.thClass') . ' ' . data_get($theme, 'table.thActionClass')); ?>"
                scope="col"
                style="<?php echo e(data_get($theme, 'table.thStyle') . ' ' . data_get($theme, 'table.thActionStyle')); ?>"
                colspan="<?php echo e(count($actions)); ?>"
                wire:key="<?php echo e(md5('actions')); ?>"
            >
                <?php echo e(trans('livewire-powergrid::datatable.labels.action')); ?>

            </th>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</tr>
<?php /**PATH /var/www/html/jkhomestay/vendor/power-components/livewire-powergrid/src/Providers/../../resources/views/components/table/tr.blade.php ENDPATH**/ ?>