<div>
    <div class="row page-title-box d-sm-flex align-items-center justify-content-between" id="scrollbar">
        <ul class="navbar-nav d-flex flex-row" id="navbar-nav">
            @foreach($features as $feature)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dashboardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="{{ $feature->feature_icon }}"></i> <span data-key="t-dashboards">{{ $feature->feature_name }}</span>
                </a>
                @if (!empty($feature->children))
                <ul class="dropdown-menu" aria-labelledby="dashboardDropdown">
                    @foreach($feature->children as $child)
                    <li><a class="dropdown-item" role="button" wire:click.prevent="navigateTo('{{ $child->feature_route_link }}')" data-key="t-{{ strtolower($child->feature_name) }}">{{ $child->feature_name }}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>