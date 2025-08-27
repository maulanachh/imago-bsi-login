<div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <!-- card body -->
            @if (session()->has('success'))
            <div class="alert alert-borderless alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Rolegroup</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="createRolegroup">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="rolegroup" class="form-label">nama rolegroup</label>
                                        <input wire:model="rolegroup" type="text" class="form-control rounded-pill">
                                        @error('rolegroup') <div class="alert alert-borderless alert-danger" role="alert">{{ $message }}</div> @enderror

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">save</button>
                                        <button wire:click="goBack" type="button" class="btn btn-light waves-effect waves-light">back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </from>
                </div>
            </div>
        </div>
    </div>
</div>