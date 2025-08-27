<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <!-- Mengambil nama dari breadcrumb terakhir -->
            <h4 class="mb-sm-0">
                {{ $breadcrumbs ? $breadcrumbs[count($breadcrumbs) - 1]['name'] : 'Default Title' }}
            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @foreach ($breadcrumbs as $breadcrumb)
                    @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $breadcrumb['name'] }}
                    </li>
                    @else
                    <li class="breadcrumb-item">
                        @if ($breadcrumb['link'])
                        <a role="button" wire:click.prevent="navigateTo('{{ $breadcrumb['link'] }}')">{{ $breadcrumb['name'] }}</a>
                        @else
                        {{ $breadcrumb['name'] }}
                        @endif
                    </li>
                    @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>