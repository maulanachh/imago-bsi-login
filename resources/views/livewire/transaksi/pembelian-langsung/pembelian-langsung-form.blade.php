<div>
    <div class="row">

        <div class="col-xl-6">
            <div class="card card-height-100">
                <!-- card body -->
                <div class="col-lg-12">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Menu Penjualan Onsite</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form wire:submit.prevent="create">
                            <div class="live-preview">
                                <div class="row gy-12">
                                    <div class="col-md-12">
                                        <div>
                                            <label for="produk_id" class="form-label">pilih produk</label>
                                            <select wire:model.live="produk_id" class="form-select mb-3"
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
                                    <div class="col-md-6">
                                        <div>
                                            <label for="harga_satuan" class="form-label">harga satuan</label>
                                            <input wire:model="harga_satuan" type="text" class="form-control"
                                                disabled>
                                            @error('harga_satuan')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="stok" class="form-label">stock barang</label>
                                            <input wire:model="stok" type="text" class="form-control" disabled>
                                            @error('stok')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="qty" class="form-label">qty barang</label>
                                            <input wire:model.live="qty" type="number" class="form-control">
                                            @error('qty')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="subtotal_harga_satuan" class="form-label">total harga</label>
                                            <input wire:model="subtotal_harga_satuan" type="number"
                                                class="form-control" disabled>
                                            @error('subtotal_harga_satuan')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="tipediskon_id" class="form-label">pilih tipe diskon</label>
                                            <select wire:model="tipediskon_id" class="form-select mb-3"
                                                aria-label="Default select example">
                                                <option value="">-- Pilih Tipe Diskon --</option>
                                                @foreach ($tipe_diskon as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                            @error('tipediskon_id')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="diskon" class="form-label">besaran diskon</label>
                                            <input wire:model="diskon" type="number" class="form-control">
                                            @error('diskon')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                    <div>
                                        <label for="tgl_lahir" class="form-label">tanggal lahir</label>
                                        <input wire:model="tgl_lahir" type="text" class="form-control"
                                            data-provider="flatpickr" data-date-format="d M, Y" disabled>
                                        @error('tgl_lahir')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                {{ $message }}</div>
                                        @enderror

                                    </div>
                                </div> --}}
                                    {{-- <div class="col-md-8">
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
                                </div> --}}


                                    <br>
                                    <div class="row gy-4">
                                        <div class="col-md-12">
                                            <div class="d-flex gap-2">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">input data</button>
                                                {{-- <button wire:click="goBack" type="button"
                                                    class="btn btn-light waves-effect waves-light">back</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-height-100">
            <!-- card body -->
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">List Order</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless align-middle mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th style="width: 90px;" scope="col">Product</th>
                                    <th scope="col">Product Info</th>
                                    <th scope="col" class="text-end">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_cart as $data)
                                    <tr>
                                        <td>
                                            <div class="avatar-md bg-light rounded p-1">
                                                <img src="{{ asset('storage/' . $data->produk_url) }}"
                                                    alt="{{ $data->nama_produk }}" class="img-fluid d-block">
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="fs-14"><a href="apps-ecommerce-product-details.html"
                                                    class="text-dark">{{ $data->produk_name }}</a>
                                            </h5>
                                            <p class="text-muted mb-0">Rp.
                                                {{ number_format($data->harga_satuan, 0, ',', '.') }} x
                                                {{ $data->qty }}</p>
                                        </td>
                                        <td class="text-end">Rp.
                                            {{ number_format($data->subtotal_harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="fw-semibold" colspan="2">Sub Total :</td>
                                    <td class="fw-semibold text-end">Rp.
                                        {{ number_format($data_kolektif->total_subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold" colspan="2">Total Discount: </td>
                                    <td class="text-end">Rp.
                                        {{ number_format($data_kolektif->total_diskon, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="table-active">
                                    <th colspan="2">Total :</th>
                                    <td class="text-end">
                                        <span class="fw-semibold">
                                            Rp.
                                            {{ number_format($data_kolektif->total_harga, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="checkout">
                        <div class="col-md-6">
                            <div>
                                <label for="karyawan_id" class="form-label">referensi pembelian</label>
                                <select wire:model="karyawan_id" class="form-select mb-3"
                                    aria-label="Default select example">
                                    <option value="">-- Pilih referensi --</option>
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
                                <label for="diskon_billing" class="form-label">diskon billing</label>
                                <input wire:model="diskon_billing" type="number" class="form-control">
                                @error('diskon_billing')
                                    <div class="alert alert-borderless alert-danger" role="alert">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">checkout
                                        barang</button>
                                    {{-- <button wire:click="goBack" type="button"
                                        class="btn btn-light waves-effect waves-light">back</button> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
