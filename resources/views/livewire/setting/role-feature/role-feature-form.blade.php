<div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <!-- card body -->
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Rolegroup Fitur</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit="createFitur">
                        <div class="live-preview">
                            <div class="row gy-12">
                                <div class="col-md-6">
                                    <div>
                                        <label for="role_id" class="form-label">Pilih Role</label>
                                        <select wire:model.live="role_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Role --</option>
                                            @foreach ($role as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="feature_id" class="form-label">Pilih Fitur</label>
                                        <select wire:model="feature_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Fitur --</option>
                                            @foreach ($features as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('feature_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
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
                            </from>
                            <div class="col-12">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">nama role</th>
                                            <th scope="col">nama fitur</th>
                                            <th scope="col">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_role_features as $data)
                                            <tr>
                                                <th scope="row"><a href="#"
                                                        class="fw-semibold">{{ $data->role_feature_id }}</a></th>
                                                <td>{{ $data->role_name }}</td>
                                                <td>{{ $data->feature_name }}</td>

                                                <td>
                                                    <button wire:click="askDelete({{ $data->role_feature_id }})"
                                                        class="btn btn-ghost-danger waves-effect waves-light"><i
                                                            class="bx bx-trash-alt"></i>delete</button>
                                                </td> <!-- Format tanpa desimal -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div>
            <!-- Modal Delete -->
            <div x-data="{
                showModal: false,
                rowId: null,
                initModal() {
                    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    window.addEventListener('openDeleteModal', (event) => {
                        this.rowId = event.detail[0].rowId;
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
                                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button wire:click="confirmRoleGroupFitur(rowId)" type="button" class="btn btn-danger"
                                    @click="
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
        @push('scripts')
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
        @endpush
    </div>
