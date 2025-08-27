<div>
    @if (session()->has('error'))
    <div>{{ session('error') }}</div>
    @endif
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
                                <h5 class="text-primary">Welcome Back !</h5>
                            </div>
                            <div class="mt-4">
                                <form wire:submit.prevent="login">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input wire:model="username" type="text" class="form-control" id="username" placeholder="Enter username">
                                        @error('username') <div class="alert alert-danger" role="alert">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input wire:model="password" type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                            @error('password') <div class="alert alert-danger" role="alert">{{ $message }}</div> @enderror
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign In</button>
                                    </div>
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
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                }
            });
        });
    </script>
</div>