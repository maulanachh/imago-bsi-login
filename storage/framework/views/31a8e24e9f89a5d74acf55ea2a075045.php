<div>
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="/dashboard" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="assets/images/header-jkh.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/header-jkh.png" alt="" height="40">
                </span>
            </a>
            <!-- Light Logo-->
            <a href="/dashboard" class="logo logo-light">
                <span class="logo-sm">
                    <img src="assets/images/header-jkh.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/header-jkh.png" alt="" height="17">
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>
        <div id="scrollbar" data-simplebar="init" class="h-100">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                            aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <div class="container-fluid">

                                    <div id="two-column-menu">
                                    </div>
                                    <ul class="navbar-nav" id="navbar-nav" data-simplebar="init">
                                        <div class="simplebar-wrapper" style="margin: 0px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                        aria-label="scrollable content"
                                                        style="height: auto; overflow: hidden;">
                                                        <div class="simplebar-content" style="padding: 0px;">
                                                            <li class="menu-title"><span data-key="t-menu">Menu</span>
                                                            </li>
                                                            <ul class="navbar-nav">
                                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link menu-link collapsed"
                                                                            wire:click="navigateTo('<?php echo e($feature->feature_route_link); ?>')"
                                                                            data-bs-toggle="collapse" role="button"
                                                                            aria-expanded="false"
                                                                            aria-controls="<?php echo e($feature->feature_name); ?>">
                                                                            <i class="<?php echo e($feature->feature_icon); ?>"></i>
                                                                            <span
                                                                                data-key="t-<?php echo e(strtolower($feature->feature_name)); ?>"><?php echo e($feature->feature_name); ?></span>
                                                                        </a>
                                                                        <!--[if BLOCK]><![endif]--><?php if(!empty($feature->children)): ?>
                                                                            <div class="collapse menu-dropdown"
                                                                                id="<?php echo e(Str::slug($feature->feature_name)); ?>">
                                                                                <ul class="nav nav-sm flex-column">
                                                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $feature->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <li class="nav-item">
                                                                                            <a href="#"
                                                                                                wire:click.prevent="navigateTo('<?php echo e($child->feature_route_link); ?>')"
                                                                                                class="nav-link"
                                                                                                data-key="t-<?php echo e(strtolower($child->feature_name)); ?>">
                                                                                                <?php echo e($child->feature_name); ?>

                                                                                            </a>
                                                                                        </li>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                                                </ul>
                                                                            </div>
                                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: 249px; height: 1287px;">
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar"
                                                style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);">
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                        </div>
                                    </ul>
                                </div>
                                <!-- Sidebar -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 1287px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar"
                    style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar"
                    style="height: 25px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div>

        <div class="sidebar-background"></div>

        <!-- Left Sidebar End -->
    </div>
</div>
<?php /**PATH /var/www/html/jkhomestay/resources/views/components/layouts/side-navbar.blade.php ENDPATH**/ ?>