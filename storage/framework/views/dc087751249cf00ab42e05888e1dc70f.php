<?php $actionRulesClass = app('PowerComponents\LivewirePowerGrid\Components\Rules\RulesController'); ?>
<?php use \PowerComponents\LivewirePowerGrid\Components\Rules\RuleManager; ?>

<?php if (isset($component)) { $__componentOriginalc2d7d00e468a4ed4de65f87d86ee2c7d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2d7d00e468a4ed4de65f87d86ee2c7d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-powergrid::components.table-base','data' => ['readyToLoad' => $readyToLoad,'theme' => $theme,'tableName' => $tableName,'lazy' => !is_null(data_get($setUp, 'lazy'))]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-powergrid::table-base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['ready-to-load' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($readyToLoad),'theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme),'table-name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableName),'lazy' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(!is_null(data_get($setUp, 'lazy')))]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <?php echo $__env->make('livewire-powergrid::components.table.tr', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('loading', null, []); ?> 
        <?php echo $__env->make('livewire-powergrid::components.table.tr', ['loading' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('body', null, []); ?> 
        <?php echo $__env->renderWhen($this->hasColumnFilters, 'livewire-powergrid::components.inline-filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

        <!--[if BLOCK]><![endif]--><?php if(is_null($data) || count($data) === 0): ?>
            <?php echo $__env->make('livewire-powergrid::components.table.th-empty', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->renderWhen($headerTotalColumn, 'livewire-powergrid::components.table-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

            <!--[if BLOCK]><![endif]--><?php if(empty(data_get($setUp, 'lazy'))): ?>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--[if BLOCK]><![endif]--><?php if(!isset($row->{$checkboxAttribute}) && $checkbox): ?>
                        <?php throw new Exception('To use checkboxes, you must define a unique key attribute in your data source.') ?>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php
                        $rowId = data_get($row, $this->realPrimaryKey);

                        $class = data_get($theme, 'table.trBodyClass');

                        $rulesValues = $actionRulesClass->recoverFromAction($row, RuleManager::TYPE_ROWS);

                        $applyRulesLoop = true;

                        $trAttributesBag = new \Illuminate\View\ComponentAttributeBag();
                        $trAttributesBag = $trAttributesBag->merge(['class' => $class]);

                        if (method_exists($this, 'actionRules')) {
                            $applyRulesLoop = $actionRulesClass->loop($this->actionRules($row), $loop);
                        }

                        if (filled($rulesValues['setAttributes']) && $applyRulesLoop) {
                            foreach ($rulesValues['setAttributes'] as $rulesAttributes) {
                                $trAttributesBag = $trAttributesBag->merge([
                                    $rulesAttributes['attribute'] => $rulesAttributes['value'],
                                ]);
                            }
                        }
                    ?>

                    <!--[if BLOCK]><![endif]--><?php if(isset($setUp['detail'])): ?>
                        <tbody
                            wire:key="tbody-<?php echo e($rowId); ?>"
                            <?php echo e($trAttributesBag); ?>

                            x-data="{ detailState: <?php if ((object) ('setUp.detail.state.' . $rowId) instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('setUp.detail.state.' . $rowId->value()); ?>')<?php echo e('setUp.detail.state.' . $rowId->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('setUp.detail.state.' . $rowId); ?>')<?php endif; ?> }"
                        >
                            <?php echo $__env->make('livewire-powergrid::components.row', [
                                'rowIndex' => $loop->index + 1,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <tr
                                x-show="detailState"
                                style="<?php echo e(data_get($theme, 'table.trBodyStyle')); ?>"
                                <?php echo e($trAttributesBag); ?>

                            >
                                <?php echo $__env->make('livewire-powergrid::components.table.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </tr>
                        </tbody>
                    <?php else: ?>
                        <tr
                            wire:key="tbody-<?php echo e($rowId); ?>"
                            style="<?php echo e(data_get($theme, 'table.trBodyStyle')); ?>"
                            <?php echo e($trAttributesBag); ?>

                        >
                            <?php echo $__env->make('livewire-powergrid::components.row', [
                                'rowIndex' => $loop->index + 1,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <?php echo $__env->renderWhen(isset($setUp['responsive']),
                        'livewire-powergrid::components.expand-container', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            <?php else: ?>
                <div>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = range(0, data_get($setUp, 'lazy.items')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $skip = $item * data_get($setUp, 'lazy.rowsPerChildren');
                            $take = data_get($setUp, 'lazy.rowsPerChildren');
                        ?>

                        <livewire:lazy-child
                            key="<?php echo e($this->getLazyKeys); ?>"
                            :child-index="$item"
                            :$this->realPrimaryKey
                            :$radio
                            :$radioAttribute
                            :$checkbox
                            :$checkboxAttribute
                            :$theme
                            :$setUp
                            :$tableName
                            :parentName="$this->getName()"
                            :columns="$this->visibleColumns"
                            :data="\PowerComponents\LivewirePowerGrid\ProcessDataSource::transform($data->skip($skip)->take($take), $this)"
                        />
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <?php echo $__env->renderWhen($footerTotalColumn, 'livewire-powergrid::components.table-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2d7d00e468a4ed4de65f87d86ee2c7d)): ?>
<?php $attributes = $__attributesOriginalc2d7d00e468a4ed4de65f87d86ee2c7d; ?>
<?php unset($__attributesOriginalc2d7d00e468a4ed4de65f87d86ee2c7d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2d7d00e468a4ed4de65f87d86ee2c7d)): ?>
<?php $component = $__componentOriginalc2d7d00e468a4ed4de65f87d86ee2c7d; ?>
<?php unset($__componentOriginalc2d7d00e468a4ed4de65f87d86ee2c7d); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/jkhomestay/vendor/power-components/livewire-powergrid/src/Providers/../../resources/views/components/table.blade.php ENDPATH**/ ?>