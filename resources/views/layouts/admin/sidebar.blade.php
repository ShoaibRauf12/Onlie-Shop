<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link @yield('dashbord')" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    {{__('Dashboard')}}
                </a>
                <a class="nav-link @yield('category')" href="{{ route('admin.category') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list "></i></div>
                    {{__('Category')}}
                </a>
                <a class="nav-link @yield('sub_category')" href="{{ route('admin.sub-category') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list "></i></div>
                    {{__('Sub Category')}}
                </a>
                <a class="nav-link @yield('brand')" href="{{ route('admin.brand') }}">
                    <div class="sb-nav-link-icon"><i class="fa-brands fa-font-awesome"></i></div>
                    {{__('Brands')}}
                </a>
                <a class="nav-link @yield('product')" href="{{ route('admin.product') }}">
                    <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt"></i></div>
                    {{__('Products')}}
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>