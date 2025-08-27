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
                        <h4 class="card-title mb-0 flex-grow-1">data karyawan</h4>
                        <div>
                            <a wire:click="createKaryawan" type="button"
                                class="btn btn-primary waves-effect waves-light">create</a>
                        </div>
                    </div><!-- end card header -->
                    <!-- card body -->
                    <div class="card-body" wire:init="loadTableKaryawan">
                        <!--[if BLOCK]><![endif]--><?php if($isTableKaryawanLoaded): ?>
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('master.sdm.karyawan.master-karyawan-table', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-818528494-0', $__slots ?? [], get_defined_vars());

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
                            <p>Apakah Anda yakin ingin menghapus karyawan: <strong x-text="jnskmrName"></strong>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger"
                                @click="
                            $wire.dispatch('confirmDeletejnspekerjaan', {
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
<?php /**PATH /var/www/html/jkhomestay/resources/views/livewire/master/sdm/karyawan/master-karyawan-index.blade.php ENDPATH**/ ?>