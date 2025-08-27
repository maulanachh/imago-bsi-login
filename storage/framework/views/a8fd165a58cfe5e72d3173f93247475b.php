<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'theme' => '',
    'inline' => null,
    'date' => null,
    'column' => null,
    'tableName' => null,
    'type' => 'datetime',
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
    'theme' => '',
    'inline' => null,
    'date' => null,
    'column' => null,
    'tableName' => null,
    'type' => 'datetime',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<?php
    $params = data_get($filter, 'params');
    $field = data_get($filter, 'field');
    $title = data_get($column, 'title');

    $customConfig = [];
    if ($params) {
        foreach ($params as $key => $value) {
            $customConfig[$key] = $value;
        }
    }

    $params = [
        'type' => $type,
        'dataField' => $field,
        'tableName' => $tableName,
        'label' => $title,
        'locale' => config('livewire-powergrid.plugins.flatpickr.locales.' . app()->getLocale()),
        'onlyFuture' => data_get($customConfig, 'only_future', false),
        'noWeekEnds' => data_get($customConfig, 'no_weekends', false),
        'customConfig' => $customConfig,
    ];
?>
<div
    wire:ignore.self
    x-data="pgFlatpickr(<?php echo \Illuminate\Support\Js::from($params)->toHtml() ?>)"
>
    <div
        class="<?php echo e(data_get($theme, 'baseClass')); ?>"
        style="<?php echo e(data_get($theme, 'baseStyle')); ?>"
    >
        <form autocomplete="off">
            <input
                id="input_<?php echo e($field); ?>"
                x-ref="rangeInput"
                wire:model="filters.<?php echo e($type); ?>.<?php echo e($field); ?>.formatted"
                autocomplete="off"
                data-field="<?php echo e($field); ?>"
                style="<?php echo e(data_get($theme, 'inputStyle')); ?> <?php echo e(data_get($column, 'headerStyle')); ?>"
                class="power_grid <?php echo e(data_get($theme, 'inputClass')); ?> <?php echo e(data_get($column, 'headerClass')); ?>"
                type="text"
                readonly
                placeholder="<?php echo e(trans('livewire-powergrid::datatable.placeholders.select')); ?>"
            />
        </form>
    </div>
</div>
<?php /**PATH /var/www/html/jkhomestay/vendor/power-components/livewire-powergrid/src/Providers/../../resources/views/components/frameworks/bootstrap5/filters/date-picker.blade.php ENDPATH**/ ?>