<div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <!-- card body -->
            <div wire:ignore>
                <div id="success_message" class="alert alert-borderless alert-success" role="alert" hidden>
                    <span id="success_message_text"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Kelas Kamar</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="createKelaskmr">
                        <div class="live-preview">
                            <div class="row gy-12">
                                <div class="col-md-6">
                                    <div>
                                        <label for="klskmr_name" class="form-label">nama kelas kamar</label>
                                        <input wire:model="klskmr_name" type="text" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['klskmr_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <label for="tarif_dasar_fullday" class="form-label">tarif dasar fullday
                                            kamar</label>
                                        <input wire:model="tarif_dasar_fullday" type="number" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tarif_dasar_fullday'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <label for="tarif_dasar_halfday" class="form-label">tarif dasar halfday
                                            kamar</label>
                                        <input wire:model.live="tarif_dasar_halfday" type="number"
                                            class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tarif_dasar_halfday'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="klskmr_desc" class="form-label">deskripsi kelas kamar</label>
                                        <input wire:model="klskmr_desc" type="text" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['klskmr_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="fasilitas" class="form-label">Fasilitas</label>
                                    <div class="row">
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fasilitasItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <!-- Checkbox -->
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model="selectedFasilitas"
                                                            value="<?php echo e($fasilitasItem->faskmr_id); ?>"
                                                            id="fasilitas_<?php echo e($fasilitasItem->faskmr_id); ?>">
                                                        <label class="form-check-label"
                                                            for="fasilitas_<?php echo e($fasilitasItem->faskmr_id); ?>">
                                                            <?php echo e($fasilitasItem->faskmr_name); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectedFasilitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <br>
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="d-flex gap-2">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">save</button>
                                            <button wire:click="goBack" type="button"
                                                class="btn btn-light waves-effect waves-light">back</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </from>
                </div>
            </div>
        </div>
        <?php $__env->startPush('scripts'); ?>
            <script>
                window.addEventListener('resetForm', event => {
                    const {
                        type,
                        message
                    } = event.detail[0];
                    Swal.fire({
                        title: type === 'success' ? 'Success' : 'Error',
                        position: 'top-end',
                        toast: true,
                        text: message,
                        icon: type,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        willClose: () => {
                            // Add additional logic here if needed
                        }
                    });
                });
            </script>
        <?php $__env->stopPush(); ?>
    </div>
<?php /**PATH /var/www/html/jkhomestay/resources/views/livewire/master/msops/kelas-kamar/kelas-kamar-form.blade.php ENDPATH**/ ?>