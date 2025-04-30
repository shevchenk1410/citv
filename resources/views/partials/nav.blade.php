@php
$usuario = auth()->user();
$menus = $usuario->rol->menus()->activo()->padres()->ordenado()->with(['menus'=>function($query){
    $query->activo()->ordenado();
}])->get();
@endphp
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menú</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                        <i class="ri-home-2-line"></i> <span>Inicio</span>
                    </a>
                </li>
                @foreach($menus as $menu)
                @php
                    $isMenuOpen = $menu->menus->contains(function($childmenu) {
                        return request()->is(trim($childmenu->url, '/'));
                    });
                @endphp
                <li class="nav-item">
                        @if($menu->url === '#')
                            <a 
                                class="nav-link menu-link" 
                                href="#page{{ str_replace(" ", "", $menu->id) }}" 
                                data-bs-toggle="collapse" 
                                role="button" 
                                aria-expanded="{{ $isMenuOpen ? 'true' : 'false' }}" 
                                aria-controls="page{{ str_replace(" ", "", $menu->id) }}">
                                <i class="{{ $menu->icono }}"></i> <span>{{ $menu->nombre }}</span>
                            </a>
                            <div class="collapse menu-dropdown {{ $isMenuOpen ? 'show' : '' }}" id="page{{ str_replace(" ", "", $menu->id) }}">
                                <ul class="nav nav-sm flex-column">
                                @foreach($menu->menus as $childmenu)
                                    <li class="nav-item">
                                        <a href="{{ $childmenu->url }}" class="nav-link {{ request()->is(trim($childmenu->url, '/')) ? 'active' : ''}}">{{ $childmenu->nombre }}</a>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        @else
                            <a class="nav-link menu-link {{ request()->is(str_replace('/','',$menu->url)) ? 'active' : '' }}" href="{{ $menu->url }}">
                                <i class="{{ $menu->icono }}"></i> <span>{{ $menu->nombre }}</span>
                            </a>
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
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
