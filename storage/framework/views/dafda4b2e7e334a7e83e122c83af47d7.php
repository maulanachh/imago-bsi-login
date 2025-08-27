<div class="dropdown">
    <button
        class="btn btn-light dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
    >
        <svg
            width="20"
            height="20"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
            />
        </svg>
    </button>
    <ul x-data="{countChecked: <?php if ((object) ('checkboxValues') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('checkboxValues'->value()); ?>')<?php echo e('checkboxValues'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('checkboxValues'); ?>')<?php endif; ?>.live}" class="dropdown-menu">
        <!--[if BLOCK]><![endif]--><?php if(in_array('xlsx', data_get($setUp, 'exportable.type'))): ?>
            <li class="d-flex">
                <div class="dropdown-item">
                    <span style="min-width: 25px;"><?php echo app('translator')->get('XLSX'); ?></span>

                    <a
                        class="text-black-50"
                        wire:click.prevent="exportToXLS"
                        href="#"
                    >
                        <span class="export-count">(<?php echo e($total); ?>)</span>
                        <!--[if BLOCK]><![endif]--><?php if(count($enabledFilters) === 0): ?>
                            <?php echo app('translator')->get('livewire-powergrid::datatable.labels.all'); ?>
                        <?php else: ?>
                            <?php echo app('translator')->get('livewire-powergrid::datatable.labels.filtered'); ?>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </a>
                    <!--[if BLOCK]><![endif]--><?php if($checkbox): ?>
                        /
                        <a
                            class="text-black-50"
                            wire:click.prevent="exportToXLS(true)"
                            href="#"
                        >
                            (<span x-text="countChecked.length"></span>) <?php echo app('translator')->get('livewire-powergrid::datatable.labels.selected'); ?>
                        </a>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </li>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <!--[if BLOCK]><![endif]--><?php if(in_array('csv', data_get($setUp, 'exportable.type'))): ?>
            <li class="d-flex">
                <div class="dropdown-item">
                    <span><?php echo app('translator')->get('Csv'); ?></span>
                    <a
                        class="text-black-50"
                        wire:click.prevent="exportToCsv"
                        href="#"
                    >
                        <span class="export-count">(<?php echo e($total); ?>)</span>
                        <!--[if BLOCK]><![endif]--><?php if(count($enabledFilters) === 0): ?>
                            <?php echo app('translator')->get('livewire-powergrid::datatable.labels.all'); ?>
                        <?php else: ?>
                            <?php echo app('translator')->get('livewire-powergrid::datatable.labels.filtered'); ?>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </a>
                    <!--[if BLOCK]><![endif]--><?php if($checkbox): ?>
                        /
                        <a
                            class="text-black-50"
                            wire:click.prevent="exportToCsv(true)"
                            x-bind:disabled="countChecked.length === 0"
                            href="#"
                        >
                            (<span x-text="countChecked.length"></span>) <?php echo app('translator')->get('livewire-powergrid::datatable.labels.selected'); ?>
                        </a>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </li>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </ul>
</div>
<?php /**PATH /var/www/html/jkhomestay/vendor/power-components/livewire-powergrid/src/Providers/../../resources/views/components/frameworks/bootstrap5/header/export.blade.php ENDPATH**/ ?>