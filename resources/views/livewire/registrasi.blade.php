<div>
    <div wire:ignore>
        <div id="success_message" class="alert alert-borderless alert-success" role="alert" hidden>
            <span id="success_message_text"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <div class="p-lg-5 p-4 auth-one-bg h-100">

                            <div class="position-relative h-100 d-flex flex-column">
                                <div class="mb-4">
                                    <a href="" class="d-block">
                                        <img src="assets/images/header-jkh-white.png" alt="" height="30">
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-lg-5 p-4">
                            <div>
                                <h5 class="text-primary">Form Registrasi</h5>
                            </div>
                            <div class="mt-4">
                                <form wire:submit.prevent="register">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input wire:model="username" type="text" class="form-control" id="username"
                                            placeholder="Enter username">
                                        @error('username')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input wire:model="email" type="email" class="form-control" id="email"
                                            placeholder="Enter email">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input wire:model="password" type="password" class="form-control"
                                            placeholder="Enter password">
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input wire:model="password_confirmation" type="password" class="form-control"
                                            placeholder="Confirm password">
                                        @error('password_confirmation')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button class="btn btn-success w-100" type="submit">Daftar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('alert', event => {
            const {
                type,
                message,
                redirectUrl
            } = event.detail[0];

            Swal.fire({
                title: type === 'success' ? 'Success' : 'Error',
                text: message,
                icon: type,
                timer: 1000, // waktu dalam milidetik (1 detik)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    // if (redirectUrl) {
                    //     window.location.href = redirectUrl;
                    // }
                }
            });
        });
    </script>
</div>
