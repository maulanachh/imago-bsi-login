<div>
    <!-- start page title -->
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
                        <h4 class="card-title mb-0 flex-grow-1">tingkat hunian</h4>
                    </div><!-- end card header -->
                    <!-- card body -->
                    <div class="card-body">
                        <form wire:submit.prevent="create">
                            <div class="live-preview">
                                <div class="row gy-12">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="tanggal_awal" class="form-label">tanggal awal</label>
                                            <input wire:model="tanggal_awal" type="text" class="form-control"
                                                data-provider="flatpickr" data-date-format="d M, Y">
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tanggal_awal'];
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
                                    <div class="col-md-6">
                                        <div>
                                            <label for="tanggal_akhir" class="form-label">tanggal akhir</label>
                                            <input wire:model="tanggal_akhir" type="text" class="form-control"
                                                data-provider="flatpickr" data-date-format="d M, Y">
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tanggal_akhir'];
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
                                    <br>
                                    <div class="row gy-4">
                                        <div class="col-md-12">
                                            <div class="d-flex gap-2">
                                                <button wire:click="ambilData" type="button"
                                                    class="btn btn-primary waves-effect waves-light">ambil data</button>
                                                <button wire:click="exportToExcel" type="button"
                                                    class="btn btn-success waves-effect waves-light">export
                                                    excel</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $data_okupasi[0] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <!--[if BLOCK]><![endif]--><?php if($key !== 'date' && $key !== 'total_occupied' && $key !== 'total_rooms' && $key !== 'percentage_occupied'): ?>
                                                        <th><?php echo e($key); ?></th>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                <th>Total Kamar Terisi</th>
                                                <th>Total Kamar</th>
                                                <th>Persentase Kamar Terisi (%)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $data_okupasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($data['date']); ?></td>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <!--[if BLOCK]><![endif]--><?php if($key !== 'date' && $key !== 'total_occupied' && $key !== 'total_rooms' && $key !== 'percentage_occupied'): ?>
                                                            <td
                                                                style="background-color: <?php echo e($value != 0 ? 'yellow' : 'transparent'); ?>;">
                                                                <?php echo e($value); ?>

                                                            </td>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                    <td
                                                        style="background-color: <?php echo e($value != 0 ? 'yellow' : 'transparent'); ?>;">
                                                        <?php echo e($data['total_occupied'] ?? ''); ?></td>
                                                    <td><?php echo e($data['total_rooms'] ?? ''); ?></td>
                                                    <td
                                                        style="background-color: <?php echo e($value != 0 ? 'yellow' : 'transparent'); ?>;">
                                                        <?php echo e($data['percentage_occupied'] ?? ''); ?> %</td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </tbody>
                                    </table>
                                </div>
                                </from>
                            </div>
                    </div>
                    <!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
    </div>
    <div>
        <!-- Modal Delete -->
        <div x-data="{
            showModal: false,
            jnskmrName: '',
            rowId: null,
            initModal() {
                const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                window.addEventListener('openDeleteModal', (event) => {
                    this.jnskmrName = event.detail.jnskmrName;
                    this.rowId = event.detail.rowId;
                    // Show modal
                    modal.show();
                });
            }
        }" x-init="initModal()">
            <!-- Modal -->
            <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus Bank : <strong x-text="jnskmrName"></strong>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger"
                                @click="
                            $wire.dispatch('confirmDelete', {
                            id: rowId
                            });
                            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                            modal.hide();">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/jkhomestay/resources/views/livewire/report/hunian/tingkat-hunian-index.blade.php ENDPATH**/ ?>