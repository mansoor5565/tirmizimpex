<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed {{ request()->is('dashboard*') ? 'active' : 'incorrect' }}"
                href="{{ url('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @foreach ($mainMenus as $menu)
            @if (!$menu->subMenus->isNotEmpty())
                <li class="nav-item">
                    @if (!Route::has($menu->route))
                        <a class="nav-link collapsed {{ request()->route()->getName() === $menu->route ? 'active' : 'incorrect' }}"
                            href="#">
                            <i class="{{ $menu->icon_class }}"></i>
                            <span>{{ $menu->title }}</span>
                        </a>
                    @else
                        {{-- @can(strtolower($menu->title) . '.list') --}}
                        <a class="nav-link collapsed {{ request()->route()->getName() === $menu->route ? 'active' : 'incorrect' }}"
                            href="{{ isset($menu->route) ? route($menu->route) : '#' }}">
                            <i class="{{ $menu->icon_class }}"></i>
                            <span>{{ $menu->title }}</span>
                        </a>
                        {{-- @endcan --}}
                    @endif
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#{{ $menu->route . '' . $menu->id }}"
                        data-bs-toggle="collapse" href="#">
                        <i class="{{ $menu->icon_class }}"></i><span>{{ $menu->title }}</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="{{ $menu->route . '' . $menu->id }}" class="nav-content collapse "
                        data-bs-parent="#sidebar-nav">
                        @foreach ($menu->subMenus as $submenu)
                            <li>
                                <a href="{{ route($submenu->route) }}">
                                    <i class="{{ $submenu->icon_class }}"></i><span>{{ $submenu->title }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
        <li class="nav-heading">Pages</li>
        @can('users.list')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('users.index') }}">
                    <i class="bi bi-person-fill"></i>
                    <span>Users</span>
                </a>
            </li>
        @endcan
        @can('permissions.list')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('permissions.index') }}">
                    <i class="bi bi-person-fill"></i>
                    <span>Permissions</span>
                </a>
            </li>
        @endcan
        <!-- End Register Page Nav -->
        @can('menu.list')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('menu.index') }}">
                    <i class="bi bi-card-list"></i>
                    <span>Main Menu Management</span>
                </a>
            </li>
        @endcan
        {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="pages-login.html">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
      </a>
    </li><!-- End Login Page Nav --> --}}

        {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="pages-error-404.html">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
      </a>
    </li><!-- End Error 404 Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-blank.html">
        <i class="bi bi-file-earmark"></i>
        <span>Blank</span>
      </a>
    </li><!-- End Blank Page Nav --> --}}

    </ul>

</aside>
