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
                    <h4 class="card-title mb-0 flex-grow-1">Form User</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="createUser">
                        <div class="live-preview">
                            <div class="row gy-12">
                                <div class="col-md-6">
                                    <div>
                                        <label for="user_name" class="form-label">username</label>
                                        <input wire:model="user_name" type="text" class="form-control">
                                        @error('user_name')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="role_id" class="form-label">role user</label>
                                        <select wire:model="role_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Role User --</option>
                                            @foreach ($roles as $id => $name)
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
                                        <label for="karyawan_id" class="form-label">nama karyawan</label>
                                        <select wire:model="karyawan_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Nama Karyawan --</option>
                                            @foreach ($karyawan as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('karyawan_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="password" class="form-label">password</label>
                                        <input wire:model="password" type="password" class="form-control">
                                        @error('password')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="confirm_password" class="form-label">konfirmasi password</label>
                                        <input wire:model="confirm_password" type="password" class="form-control">
                                        @error('confirm_password')
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
