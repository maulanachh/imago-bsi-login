<div>
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
                        <h4 class="card-title mb-0 flex-grow-1">List Fitur</h4>
                        <div>
                            <a wire:click="createFeature" type="button" class="btn btn-primary waves-effect waves-light">create Fitur</a>
                        </div>
                    </div><!-- end card header -->
                    <!-- card body -->
                    <div class="card-body" wire:init="loadTableRoleFeature">
                        @if ($isTableRoleFeatureLoaded)
                        <livewire:setting.RoleFeature.role-feature-table />
                        @else
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        @endif
                    </div>
                    <!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
    </div>
</div>