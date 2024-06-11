    <!-- ========== App Menu ========== -->
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
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                        </a>

                    </li> <!-- end Dashboard Menu -->


                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                            <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Danh sách Danh mục</span>
                            {{-- <span class="badge badge-pill bg-danger" data-key="t-hot">Hot</span> --}}
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarCategories">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.brands.index') }}" target="_blank" class="nav-link" data-key="t-horizontal">Brands</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.index') }}" target="_blank" class="nav-link" data-key="t-horizontal">Categories</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.products.index') }}" target="_blank" class="nav-link" data-key="t-horizontal">Products</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.tags.index') }}" target="_blank" class="nav-link" data-key="t-horizontal">Tags</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.banners.index') }}" target="_blank" class="nav-link" data-key="t-horizontal">Banners</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->

                </ul>
            </div>
            <!-- Sidebar -->
        </div>
