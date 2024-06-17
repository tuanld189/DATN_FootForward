<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCategories">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Quản lí chức năng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <!-- Categories -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarCategory" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarCategory">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Categories</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCategory">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.categories.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.categories.create') }}" class="nav-link"
                                                data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Brand -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarBrand" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarBrand">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Brand</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarBrand">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.brands.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.brands.create') }}" class="nav-link"
                                                data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Product -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarProduct" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarProduct">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Product</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarProduct">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.products.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.products.create') }}" class="nav-link"
                                                data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Posts -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarPost" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarPost">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Posts</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarPost">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.posts.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.posts.create') }}" class="nav-link"
                                                data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Tags -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarTag" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarTag">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Tags</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTag">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.tags.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.tags.create') }}" class="nav-link"
                                                data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Banners -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarBanner" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarBanner">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Banners</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarBanner">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.banners.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.banners.create') }}" class="nav-link"
                                                data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Vouchers -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarVoucher" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarVoucher">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Vouchers</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarVoucher">
                                    <ul class="nav nav-sm flex-column">
                                        {{-- <li class="nav-item">
                                            <a href="{{ route('admin.vouchers.index') }}" class="nav-link" data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.vouchers.create') }}" class="nav-link" data-key="t-horizontal">Thêm mới</a>
                                        </li> --}}

                                        <li class="nav-item">
                                            <a href="{{ route('admin.vourchers.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh
                                                sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.vourchers.create') }}" target="_blank"
                                                class="nav-link" data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>


                                </div>
                            </li>
                            <!-- Users -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarUser" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarUser">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Users</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarUser">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.users.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.users.create') }}" class="nav-link"
                                                data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Permissions -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarPermission" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarPermission">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Permissions</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarPermission">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.permissions.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.permissions.create') }}" class="nav-link"
                                                data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Roles -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarRole" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarRole">
                                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Roles</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarRole">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ url('admin.roles.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh
                                                sách</a>
                                            {{-- <a href="{{ route('admin.roles.index') }}" class="nav-link"
                                                data-key="t-horizontal">Roles</a> --}}
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('admin.roles.create') }}" target="_blank"
                                                class="nav-link" data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>


                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
