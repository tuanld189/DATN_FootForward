<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">

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
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Quản lí sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <!-- Categories -->
                            <li class="nav-item">
                                <a href="{{ route('admin.brands.index') }}" class="nav-link"
                                    data-key="t-horizontal">Brands</a>
                            </li>
                            {{-- Categories --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}" class="nav-link"
                                    data-key="t-horizontal">Categories</a>
                            </li>
                            {{-- Products --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link"
                                    data-key="t-horizontal">Products</a>
                            </li>
                            {{-- Up sells --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.sales.index') }}" class="nav-link" data-key="t-horizontal">Up
                                    Sell</a>
                            </li>

                          {{-- end người dùng --}}


                            {{-- <!-- Posts -->
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
                                        <li class="nav-item">
                                            <a href="{{ route('admin.vourchers.index') }}" class="nav-link"
                                                data-key="t-horizontal">Danh sách</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.vourchers.create') }}" class="nav-link"
                                                data-key="t-horizontal">Thêm mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}

                        </ul>
                    </div>
                </li> <!-- end Products Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCategories">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Quản lí người dùng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            {{-- Permissions --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link"
                                    data-key="t-horizontal">Permissions</a>
                            </li>

                            {{-- Roles --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link"
                                    data-key="t-horizontal">Roles</a>
                            </li>
                            {{-- Users --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link"
                                    data-key="t-horizontal">Users</a>
                            </li>

                        </ul>
                    </div>
                </li> <!-- end users Menu -->

                {{-- Posts --}}
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link" data-key="t-horizontal">Posts</a>
                </li>
                {{-- Banners --}}
                <li class="nav-item">
                    <a href="{{ route('admin.banners.index') }}" class="nav-link" data-key="t-horizontal">Banners</a>
                </li>

                  {{-- Vourchers --}}
                  <li class="nav-item">
                    <a href="{{ route('admin.vourchers.index') }}" class="nav-link" data-key="t-horizontal">Vourchers</a>
                </li>

                {{-- Comments --}}
                <li class="nav-item">
                    <a href="{{ route('admin.comments.index') }}" class="nav-link"
                        data-key="t-horizontal">Comment</a>

                </li>

            </ul>
        </div>
    </div>
</div>
