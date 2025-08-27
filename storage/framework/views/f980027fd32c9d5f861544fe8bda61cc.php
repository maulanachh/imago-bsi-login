<div>
    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
    <div class="alert alert-borderless alert-success" role="alert">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <!-- end page title -->
    <!-- container-fluid -->
    <div class="container-fluid col-xxl-12">
        <div class="row h-100">
            <div class="col-xl-12">
                <div class="card card-height-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">List Fitur</h4>
                        <div>
                            <a wire:click="createFeature" type="button" class="btn btn-primary waves-effect waves-light">create Fitur</a>
                        </div>
                    </div><!-- end card header -->
                    <!-- card body -->
                    <div class="card-body" wire:init="loadTableRoleFeature">
                        <!--[if BLOCK]><![endif]--><?php if($isTableRoleFeatureLoaded): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('setting.RoleFeature.role-feature-table', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-210300829-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php else: ?>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
    </div>
</div><?php /**PATH /var/www/html/jkhomestay/resources/views/livewire/setting/role-feature/role-feature-index.blade.php ENDPATH**/ ?>