<div>
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-dark.png" alt="" height="17">
                </span>
            </a>
            <!-- Light Logo-->
            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-light.png" alt="" height="17">
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <div class="container-fluid">

                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    @foreach($features as $feature)
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed" wire:click.prevent="navigateTo('{{ $feature->feature_route_link }}')" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{ $feature->feature_name }}">
                            <i class="{{ $feature->feature_icon }}"></i> <span data-key="t-{{ strtolower($feature->feature_name) }}">{{ $feature->feature_name }}</span>
                        </a>
                        @if (!empty($feature->children))
                        <div class="collapse menu-dropdown" id="{{ Str::slug($feature->feature_name) }}">
                            <ul class="nav nav-sm flex-column">
                                @foreach($feature->children as $child)
                                <li class="nav-item">
                                    <a href="#" wire:click.prevent="navigateTo('{{ $child->feature_route_link }}')" class="nav-link" data-key="t-{{ strtolower($child->feature_name) }}"> {{ $child->feature_name }} </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- Sidebar -->
        </div>

        <div class="sidebar-background"></div>
    </div>
    <!-- Left Sidebar End -->
</div>