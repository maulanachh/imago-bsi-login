<div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <!-- card body -->
            <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
            <div class="alert alert-borderless alert-success" role="alert">
                <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Rolegroup</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="createRolegroup">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="rolegroup" class="form-label">nama rolegroup</label>
                                        <input wire:model="rolegroup" type="text" class="form-control rounded-pill">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['rolegroup'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-borderless alert-danger" role="alert"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">save</button>
                                        <button wire:click="goBack" type="button" class="btn btn-light waves-effect waves-light">back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </from>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/html/jkhomestay/resources/views/livewire/setting/role/role-group-form.blade.php ENDPATH**/ ?>