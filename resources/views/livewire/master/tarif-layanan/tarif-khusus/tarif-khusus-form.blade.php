<div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <!-- card body -->
            <div wire:ignore>
                <div id="success_message" class="alert alert-borderless alert-success" role="alert" hidden>
                    <span id="success_message_text"></span>
                </div>
            </div>
            <div wire:ignore>
                <div id="error_message" class="alert alert-borderless alert-danger" role="alert" hidden>
                    <span id="error_message_text"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Tarif Kamar Khusus</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="createTarifKhusus">
                        <div class="live-preview">
                            <div class="row gy-12">
                                <div class="col-md-12">
                                    <div>
                                        <label for="klskmr_id" class="form-label">Kelas Kamar</label>
                                        <select wire:model="klskmr_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Kelas Kamar --</option>
                                            @foreach ($kelasKamars as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('klskmr_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="tanggal_awal" class="form-label">tanggal awal event</label>
                                        <input wire:model="tanggal_awal" type="text" class="form-control"
                                            data-provider="flatpickr" data-date-format="d.m.y" data-enable-time>
                                        @error('tanggal_awal')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="tanggal_akhir" class="form-label">tanggal akhir event</label>
                                        <input wire:model="tanggal_akhir" type="text" class="form-control"
                                            data-provider="flatpickr" data-date-format="d.m.y" data-enable-time>
                                        @error('tanggal_akhir')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="trkhusus_fullday" class="form-label">tarif khusus fullday</label>
                                        <input wire:model="trkhusus_fullday" type="number" class="form-control">
                                        @error('trkhusus_fullday')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="trkhusus_halfday" class="form-label">tarif khusus halfday</label>
                                        <input wire:model="trkhusus_halfday" type="number" class="form-control">
                                        @error('trkhusus_halfday')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="keterangan" class="form-label">keterangan</label>
                                        <input wire:model="keterangan" type="text" class="form-control">
                                        @error('keterangan')
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
                        </div>
                        </from>
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
                window.addEventListener('showError', event => {
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
