<div>
    <!-- start page title -->
    @if (session()->has('success'))
        <div class="alert alert-borderless alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <!-- end page title -->
    <!-- container-fluid -->
    <div class="container-fluid col-xxl-12">
        <div class="row h-100">
            <div class="col-xl-12">
                <div class="card card-height-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">tingkat hunian</h4>
                    </div><!-- end card header -->
                    <!-- card body -->
                    <div class="card-body">
                        <form wire:submit.prevent="create">
                            <div class="live-preview">
                                <div class="row gy-12">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="tanggal_awal" class="form-label">tanggal awal</label>
                                            <input wire:model="tanggal_awal" type="text" class="form-control"
                                                data-provider="flatpickr" data-date-format="d M, Y">
                                            @error('tanggal_awal')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="tanggal_akhir" class="form-label">tanggal akhir</label>
                                            <input wire:model="tanggal_akhir" type="text" class="form-control"
                                                data-provider="flatpickr" data-date-format="d M, Y">
                                            @error('tanggal_akhir')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row gy-4">
                                        <div class="col-md-12">
                                            <div class="d-flex gap-2">
                                                <button wire:click="ambilData" type="button"
                                                    class="btn btn-primary waves-effect waves-light">ambil data</button>
                                                <button wire:click="exportToExcel" type="button"
                                                    class="btn btn-success waves-effect waves-light">export
                                                    excel</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                @foreach ($data_okupasi[0] ?? [] as $key => $value)
                                                    @if ($key !== 'date' && $key !== 'total_occupied' && $key !== 'total_rooms' && $key !== 'percentage_occupied')
                                                        <th>{{ $key }}</th>
                                                    @endif
                                                @endforeach
                                                <th>Total Kamar Terisi</th>
                                                <th>Total Kamar</th>
                                                <th>Persentase Kamar Terisi (%)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_okupasi as $data)
                                                <tr>
                                                    <td>{{ $data['date'] }}</td>
                                                    @foreach ($data as $key => $value)
                                                        @if ($key !== 'date' && $key !== 'total_occupied' && $key !== 'total_rooms' && $key !== 'percentage_occupied')
                                                            <td
                                                                style="background-color: {{ $value != 0 ? 'yellow' : 'transparent' }};">
                                                                {{ $value }}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    <td
                                                        style="background-color: {{ $value != 0 ? 'yellow' : 'transparent' }};">
                                                        {{ $data['total_occupied'] ?? '' }}</td>
                                                    <td>{{ $data['total_rooms'] ?? '' }}</td>
                                                    <td
                                                        style="background-color: {{ $value != 0 ? 'yellow' : 'transparent' }};">
                                                        {{ $data['percentage_occupied'] ?? '' }} %</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                </from>
                            </div>
                    </div>
                    <!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
    </div>
    <div>
        <!-- Modal Delete -->
        <div x-data="{
            showModal: false,
            jnskmrName: '',
            rowId: null,
            initModal() {
                const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                window.addEventListener('openDeleteModal', (event) => {
                    this.jnskmrName = event.detail.jnskmrName;
                    this.rowId = event.detail.rowId;
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
                            <p>Apakah Anda yakin ingin menghapus Bank : <strong x-text="jnskmrName"></strong>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger"
                                @click="
                            $wire.dispatch('confirmDelete', {
                            id: rowId
                            });
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
</div>
