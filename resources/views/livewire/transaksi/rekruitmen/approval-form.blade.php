<div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <!-- card body -->
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Karyawan</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="create">
                        <div class="live-preview">
                            <div class="row gy-12">
                                <div class="col-md-6">
                                    <div>
                                        <label for="karyawan_name" class="form-label">nama karyawan</label>
                                        <input wire:model="karyawan_name" type="text" class="form-control" disabled>
                                        @error('karyawan_name')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="tempat_lahir" class="form-label">tempat lahir</label>
                                        <input wire:model="tempat_lahir" type="text" class="form-control" disabled>
                                        @error('tempat_lahir')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label for="tgl_lahir" class="form-label">tanggal lahir</label>
                                        <input wire:model="tgl_lahir" type="text" class="form-control"
                                            data-provider="flatpickr" data-date-format="d M, Y" disabled>
                                        @error('tgl_lahir')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div>
                                        <label for="alamat" class="form-label">alamat</label>
                                        <input wire:model="alamat" type="text" class="form-control" disabled>
                                        @error('alamat')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="phone" class="form-label">no. telefon</label>
                                        <input wire:model="phone" type="number" class="form-control" disabled>
                                        @error('phone')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="jenkel_id" class="form-label">jenis kelamin</label>
                                        <select wire:model="jenkel_id" class="form-select mb-3"
                                            aria-label="Default select example" disabled>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            @foreach ($jenis_kelamin as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenkel_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="v" class="form-label">pendidikan terakhir</label>
                                        <select wire:model="pendidikan_id" class="form-select mb-3"
                                            aria-label="Default select example" disabled>
                                            <option value="">-- Pilih Pendidikan --</option>
                                            @foreach ($pendidikan as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pendidikan_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="pekerjaan_id" class="form-label">jenis pekerjaan</label>
                                        <select wire:model.live="pekerjaan_id" class="form-select mb-3"
                                            aria-label="Default select example" disabled>
                                            <option value="">-- Pilih Jenis Pekerjaan --</option>
                                            @foreach ($jenis_pekerjaan as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pekerjaan_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="leader_id" class="form-label">pilih leader</label>
                                        <select wire:model="leader_id" class="form-select mb-3"
                                            aria-label="Default select example" disabled>
                                            <option value="">-- Pilih Leader --</option>
                                            @foreach ($leader as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('leader_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="sttsrekruit_id" class="form-label">pilih status approval</label>
                                        <select wire:model="sttsrekruit_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Status Approval --</option>
                                            @foreach ($approval as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sttsrekruit_id')
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
</div>
