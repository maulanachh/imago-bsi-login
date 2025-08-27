<?php use \PowerComponents\LivewirePowerGrid\Components\Rules\RuleManager; ?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'rowIndex' => 0,
    'childIndex' => null
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
    'rowIndex' => 0,
    'childIndex' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php echo $__env->renderWhen(isset($setUp['responsive']), powerGridThemeRoot() . '.toggle-detail-responsive', [
    'theme' => data_get($theme, 'table'),
    'rowId' => $rowId,
    'view' => data_get($setUp, 'detail.viewIcon') ?? null,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

<?php
    // =============* Get Rules *=====================
    $rowRules = $actionRulesClass->recoverFromAction($row, RuleManager::TYPE_ROWS);

    // =============* Toggle Detail Rules *=====================
    $showToggleDetail = data_get($setUp, 'detail.showCollapseIcon');

    $toggleDetailVisibilityRowRules = collect(data_get($rowRules, 'ToggleDetailVisibility', []));

    if ($toggleDetailVisibilityRowRules) {
        // Has permission, but Row Action Rule is changing to hide
        if ($showToggleDetail && $toggleDetailVisibilityRowRules->last() == 'hide')
        {
            $showToggleDetail = false;
        }

        // No permission, but Row Action Rule is forcing to show
        if (!$showToggleDetail && $toggleDetailVisibilityRowRules->last() == 'show')
        {
            $showToggleDetail = true;
        }
    }

    $toggleDetailView = powerGridThemeRoot() . ($showToggleDetail ? '.toggle-detail' : '.no-toggle-detail');
?>

<?php echo $__env->renderWhen(data_get($setUp, 'detail.showCollapseIcon'), $toggleDetailView, [
    'theme' => data_get($theme, 'table'),
    'view' => data_get($setUp, 'detail.viewIcon') ?? null,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

<?php echo $__env->renderWhen($radio, 'livewire-powergrid::components.radio-row', [
    'attribute' => $row->{$radioAttribute},
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

<?php echo $__env->renderWhen($checkbox, 'livewire-powergrid::components.checkbox-row', [
    'attribute' => $row->{$checkboxAttribute},
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

<!--[if BLOCK]><![endif]--><?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $content = $row->{$column->field} ?? '';
        $contentClassField = $column->contentClassField != '' ? $row->{$column->contentClassField} : '';
        $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content ?? '');
        $field = $column->dataField != '' ? $column->dataField : $column->field;

        $contentClass = $column->contentClasses;

        if (is_array($column->contentClasses)) {
            $contentClass = array_key_exists($content, $column->contentClasses) ? $column->contentClasses[$content] : '';
        }
    ?>
    <td
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([ data_get($theme, 'table.tdBodyClass'), $column->bodyClass]); ?>"
        style="<?php echo e($column->hidden === true ? 'display:none' : ''); ?>; <?php echo e(data_get($theme, 'table.tdBodyStyle'). ' ' . $column->bodyStyle ?? ''); ?>"
        wire:key="row-<?php echo e($column->field); ?>-<?php echo e($childIndex); ?>"
    >
        <div class="pg-actions">
            <!--[if BLOCK]><![endif]--><?php if(empty(data_get($row, 'actions')) && $column->isAction): ?>
                <!--[if BLOCK]><![endif]--><?php if(method_exists($this, 'actionsFromView') && $actionsFromView = $this->actionsFromView($row)): ?>
                    <div wire:key="actions-view-<?php echo e(data_get($row, $this->realPrimaryKey)); ?>">
                        <?php echo $actionsFromView; ?>

                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!--[if BLOCK]><![endif]--><?php if(filled(data_get($row, 'actions')) && $column->isAction): ?>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = data_get($row, 'actions'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--[if BLOCK]><![endif]--><?php if(filled($action)): ?>
                        <span wire:key="action-<?php echo e(data_get($row, $this->realPrimaryKey)); ?>-<?php echo e($key); ?>">
                            <?php echo $action; ?>

                        </span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
        <?php
        // =============* Get Field Rules *=====================
        $hasFieldRules = $actionRulesClass->recoverActionForField($row, $field);

        // =============* Edit On Click *=====================

        $showEditOnClick = false;

        if (data_get($column->editable, 'hasPermission')) {
            $showEditOnClick = true;
        }

        // Check if there is any Role Row for Edit on click
        $editOnClickRowRules = collect(data_get($rowRules, 'EditOnClickVisibility', []));

        if ($editOnClickRowRules) {
            // Has permission, but Row Action Rule is changing to hide
            if ($showEditOnClick && $editOnClickRowRules->last() == 'hide')
            {
                $showEditOnClick = false;
            }

            // No permission, but Row Action Rule is forcing to show
            if (!$showEditOnClick && $editOnClickRowRules->last() == 'show')
            {
                $showEditOnClick = true;
            }
        }

        // Particular Rule for this field
        if (isset($hasFieldRules['field_hide_editonclick'])) {
            $showEditOnClick = !$hasFieldRules['field_hide_editonclick'];
        }

        if (str_contains($field, '.') === true) {
             $showEditOnClick = false;
        }
        ?>

        <!--[if BLOCK]><![endif]--><?php if($showEditOnClick === true): ?>
            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([$contentClassField, $contentClass]); ?>">
                <?php echo $__env->make(data_get($theme, 'editable.view') ?? null, ['editable' => $column->editable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </span>

        
        <?php elseif(count($column->toggleable) > 0): ?>
            <?php
                //Default Toggle Permission
                $showToggleable = data_get($column->toggleable, 'enabled', false);

                $toggleableRowRules = collect(data_get($rowRules, 'ToggleableVisibility', []));

                // Has permission, but Row Action Rule is changing to hide
                if ($showToggleable && $toggleableRowRules->last() == 'hide')
                {
                    $showToggleable = false;
                }

                // No permission, but Row Action Rule is forcing to show
                if (!$showToggleable && $toggleableRowRules->last() == 'show')
                {
                    $showToggleable = true;
                }

                // Particular Rule for this field
                if (isset($hasFieldRules['field_hide_toggleable'])) {
                    $showToggleable = !$hasFieldRules['field_hide_toggleable'];
                }

                if (str_contains($field, '.') === true) {
                    $showToggleable = false;
                }

            ?>
            <?php echo $__env->make(data_get($theme, 'toggleable.view'), ['tableName' => $tableName], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([$contentClassField, $contentClass]); ?>">
                <div><?php echo $column->index ? $rowIndex : $content; ?></div>
            </span>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </td>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH /var/www/html/jkhomestay/vendor/power-components/livewire-powergrid/src/Providers/../../resources/views/components/row.blade.php ENDPATH**/ ?>