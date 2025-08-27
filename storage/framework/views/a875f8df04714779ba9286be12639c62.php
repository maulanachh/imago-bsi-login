<div>
    <div class="row page-title-box d-sm-flex align-items-center justify-content-between" id="scrollbar">
        <ul class="navbar-nav d-flex flex-row" id="navbar-nav">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dashboardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="<?php echo e($feature->feature_icon); ?>"></i> <span data-key="t-dashboards"><?php echo e($feature->feature_name); ?></span>
                </a>
                <!--[if BLOCK]><![endif]--><?php if(!empty($feature->children)): ?>
                <ul class="dropdown-menu" aria-labelledby="dashboardDropdown">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $feature->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a class="dropdown-item" role="button" wire:click.prevent="navigateTo('<?php echo e($child->feature_route_link); ?>')" data-key="t-<?php echo e(strtolower($child->feature_name)); ?>"><?php echo e($child->feature_name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </ul>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </ul>
    </div>
</div><?php /**PATH /var/www/html/jkhomestay/resources/views/components/layouts/topbar-menu.blade.php ENDPATH**/ ?>