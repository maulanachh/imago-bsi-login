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
                    <h4 class="card-title mb-0 flex-grow-1">Form Produk</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="create">
                        <div class="live-preview">
                            <div class="row gy-12">
                                <div class="col-md-12">
                                    <div class="form-check mb-2" style="margin-top: 12px;">
                                        <input class="form-check-input" type="checkbox" id="is_parent"
                                            wire:model="produk_utama">
                                        <label class="form-check-label" for="is_parent">
                                            produk utama
                                        </label>
                                        @error('produk_utama')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="produk_name" class="form-label">nama produk</label>
                                        <input wire:model="produk_name" type="text" class="form-control">
                                        @error('produk_name')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="katproduk_id" class="form-label">kategori produk</label>
                                        <select wire:model="katproduk_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Kategori Produk --</option>
                                            @foreach ($kategori_produk as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('katproduk_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="satuan_id" class="form-label">satuan berat</label>
                                        <select wire:model="satuan_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Satuan Berat --</option>
                                            @foreach ($satuan_berat as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('satuan_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="berat_produk" class="form-label">nominal berat</label>
                                        <input wire:model="berat_produk" type="text" class="form-control">
                                        @error('berat_produk')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="produk_url" class="form-label">Foto Produk</label>
                                        <input wire:model="produk_url" type="file" class="form-control"
                                            accept="image/*">
                                        @error('produk_url')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <!-- Preview Image -->
                                        @if ($produk_url && is_object($produk_url))
                                            <div class="mt-2">
                                                <img src="{{ $produk_url->temporaryUrl() }}" class="img-fluid"
                                                    style="max-width: 200px;">
                                            </div>
                                        @elseif ($produk_url && is_string($produk_url))
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $produk_url) }}" class="img-fluid"
                                                    style="max-width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div>
                                        <label for="about_produk" class="form-label">keterangan produk</label>
                                        <div wire:ignore>
                                            <textarea id="about_produk" wire:model="about_produk" class="ckeditor-classic"></textarea>
                                        </div>
                                        @error('about_produk')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
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
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(() => {
                        const editorElement = document.querySelector('.ck-editor__editable');

                        if (editorElement) {
                            // Tangkap perubahan text
                            editorElement.addEventListener('input', function() {
                                updateContent(editorElement);
                            });

                            // Tangkap perubahan formatting
                            editorElement.addEventListener('keyup', function() {
                                updateContent(editorElement);
                            });

                            // Tangkap perubahan melalui toolbar (bold, italic, dll)
                            const observer = new MutationObserver(function(mutations) {
                                updateContent(editorElement);
                            });

                            observer.observe(editorElement, {
                                childList: true,
                                subtree: true,
                                characterData: true,
                                attributes: true
                            });

                            // Fungsi untuk update konten
                            function updateContent(element) {
                                const content = element.innerHTML;
                                console.log(content);
                                @this.set('about_produk', content);
                            }
                        } else {
                            console.log('Editor element not found');
                        }
                    }, 1000);
                });
            </script>
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
                        willClose: () => {}
                    });
                });
            </script>
        @endpush
    </div>
