<div>
    <!-- start page title -->
    @if (session()->has('success'))
    <div class="alert alert-borderless alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <!-- end page title -->
    <!-- container-fluid -->
    <div class="container-fluid col-xxl-12">
        <div class="row h-100">
            <div class="col-xl-12">
                <div class="card card-height-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">list reservasi</h4>
                        <div>
                            <a wire:click="createRSV" type="button" class="btn btn-primary waves-effect waves-light">create</a>
                        </div>
                    </div><!-- end card header -->
                    <!-- card body -->
                    <div class="card-body" wire:init="loadTableRSV">
                        @if ($isTableRsvLoaded)
                        <livewire:transaksi.rsv-langsung.rsv-langsung-table />
                        @else
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
                        @endif
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
        kamarName: '',
        rowId: null,
        initModal() {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        window.addEventListener('openDeleteModal', (event) => {
            this.kamarName = event.detail.kamarName;
            this.rowId = event.detail.rowId;
            // Show modal
            modal.show();
        });
    }
    }"
            x-init="initModal()">
            <!-- Modal -->
            <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus tarif kamar: <strong x-text="kamarName"></strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="button"
                                class="btn btn-danger"
                                @click="
                            $wire.dispatch('confirmDeleteTarifKhusus', {
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