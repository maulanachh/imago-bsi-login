<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <!-- Mengambil nama dari breadcrumb terakhir -->
            <h4 class="mb-sm-0">
                <?php echo e($breadcrumbs ? $breadcrumbs[count($breadcrumbs) - 1]['name'] : 'Default Title'); ?>

            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--[if BLOCK]><![endif]--><?php if($loop->last): ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo e($breadcrumb['name']); ?>

                    </li>
                    <?php else: ?>
                    <li class="breadcrumb-item">
                        <!--[if BLOCK]><![endif]--><?php if($breadcrumb['link']): ?>
                        <a role="button" wire:click.prevent="navigateTo('<?php echo e($breadcrumb['link']); ?>')"><?php echo e($breadcrumb['name']); ?></a>
                        <?php else: ?>
                        <?php echo e($breadcrumb['name']); ?>

                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </li>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </ol>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/html/jkhomestay/resources/views/livewire/breadcrumb.blade.php ENDPATH**/ ?>