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
                                        @error('klskmr_name')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <label for="tarif_dasar_fullday" class="form-label">tarif dasar fullday
                                            kamar</label>
                                        <input wire:model="tarif_dasar_fullday" type="number" class="form-control">
                                        @error('tarif_dasar_fullday')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <label for="tarif_dasar_halfday" class="form-label">tarif dasar halfday
                                            kamar</label>
                                        <input wire:model.live="tarif_dasar_halfday" type="number"
                                            class="form-control">
                                        @error('tarif_dasar_halfday')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="klskmr_desc" class="form-label">deskripsi kelas kamar</label>
                                        <input wire:model="klskmr_desc" type="text" class="form-control">
                                        @error('klskmr_desc')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="fasilitas" class="form-label">Fasilitas</label>
                                    <div class="row">
                                        @foreach ($fasilitas as $fasilitasItem)
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <!-- Checkbox -->
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model="selectedFasilitas"
                                                            value="{{ $fasilitasItem->faskmr_id }}"
                                                            id="fasilitas_{{ $fasilitasItem->faskmr_id }}">
                                                        <label class="form-check-label"
                                                            for="fasilitas_{{ $fasilitasItem->faskmr_id }}">
                                                            {{ $fasilitasItem->faskmr_name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('selectedFasilitas')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
            </script>
        @endpush
    </div>
