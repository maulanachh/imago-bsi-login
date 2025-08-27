<div>
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="/dashboard" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="assets/images/nasa.PNG" alt="" height="100">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/nasa.PNG" alt="" height="100">
                </span>
            </a>
            <!-- Light Logo-->
            <a href="/dashboard" class="logo logo-light">
                <span class="logo-sm">
                    <img src="assets/images/nasa.PNG" alt="" height="100">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/nasa.PNG" alt="" height="100">
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>
        <div id="scrollbar" data-simplebar="init" class="h-100">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                            aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <div class="container-fluid">

                                    <div id="two-column-menu">
                                    </div>
                                    <ul class="navbar-nav" id="navbar-nav" data-simplebar="init">
                                        <div class="simplebar-wrapper" style="margin: 0px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                        aria-label="scrollable content"
                                                        style="height: auto; overflow: hidden;">
                                                        <div class="simplebar-content" style="padding: 0px;">
                                                            <li class="menu-title"><span data-key="t-menu">Menu</span>
                                                            </li>
                                                            <ul class="navbar-nav">
                                                                @foreach ($features as $feature)
                                                                    <li class="nav-item">
                                                                        <a class="nav-link menu-link collapsed"
                                                                            wire:click="navigateTo('{{ $feature->feature_route_link }}')"
                                                                            data-bs-toggle="collapse" role="button"
                                                                            aria-expanded="false"
                                                                            aria-controls="{{ $feature->feature_name }}">
                                                                            <i class="{{ $feature->feature_icon }}"></i>
                                                                            <span
                                                                                data-key="t-{{ strtolower($feature->feature_name) }}">{{ $feature->feature_name }}</span>
                                                                        </a>
                                                                        @if (!empty($feature->children))
                                                                            <div class="collapse menu-dropdown"
                                                                                id="{{ Str::slug($feature->feature_name) }}">
                                                                                <ul class="nav nav-sm flex-column">
                                                                                    @foreach ($feature->children as $child)
                                                                                        <li class="nav-item">
                                                                                            <a href="#"
                                                                                                wire:click.prevent="navigateTo('{{ $child->feature_route_link }}')"
                                                                                                class="nav-link"
                                                                                                data-key="t-{{ strtolower($child->feature_name) }}">
                                                                                                {{ $child->feature_name }}
                                                                                            </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: 249px; height: 1287px;">
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar"
                                                style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);">
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                        </div>
                                    </ul>
                                </div>
                                <!-- Sidebar -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 1287px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar"
                    style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar"
                    style="height: 25px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div>

        <div class="sidebar-background"></div>

        <!-- Left Sidebar End -->
    </div>
</div>
