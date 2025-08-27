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
                    <h4 class="card-title mb-0 flex-grow-1">Form F A Q</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="create">
                        <div class="live-preview">
                            <div class="row gy-12">
                                <div class="col-md-6">
                                    <div>
                                        <label for="produk_id" class="form-label">nama produk</label>
                                        <select wire:model="produk_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach ($produk as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('produk_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row gy-12">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="faq_question" class="form-label">pertanyaan</label>
                                            <input wire:model="faq_question" type="text" class="form-control">
                                            @error('faq_question')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="faq_answer" class="form-label">jawaban</label>
                                            <input wire:model="faq_answer" type="text" class="form-control">
                                            @error('faq_answer')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
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
                window.addEventListener('notifikasi', event => {
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
