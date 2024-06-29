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
                {{-- <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17"> --}}
                <h3 class="text-white m-2">FOOTFORWARD</h3>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">

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




                        </ul>
                    </div>
                </li> <!-- end Products Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarusers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarusers">
                        <i class="ri-account-circle-line"></i> <span data-key="t-layouts">Quản lí người dùng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarusers">
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

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarorders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarorders">
                        <i class="ri-file-list-2-line"></i> <span data-key="t-layouts">Quản lí đơn hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarorders">
                        <ul class="nav nav-sm flex-column">
                            {{-- Posts --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link"
                                    data-key="t-horizontal">Orders</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPosts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPosts">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-layouts">Quản lí bài viết</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPosts">
                        <ul class="nav nav-sm flex-column">
                            {{-- Posts --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.posts.index') }}" class="nav-link"
                                    data-key="t-horizontal">Posts</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBanners" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarBanners">
                        <i class="ri-honour-line"></i> <span data-key="t-layouts">Quản lí Banner</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBanners">
                        <ul class="nav nav-sm flex-column">
                            {{-- Banners --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.banners.index') }}" class="nav-link"
                                    data-key="t-horizontal">Banners</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarVouchers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarVouchers">
                        <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-layouts">Quản lí Vouchers</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarVouchers">
                        <ul class="nav nav-sm flex-column">
                            {{-- Vourchers --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.vourchers.index') }}" class="nav-link"
                                    data-key="t-horizontal">Vourchers</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarComment" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarComment">
                        <i class="ri-pages-line"></i> <span data-key="t-layouts">Quản lí bình luận</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarComment">
                        <ul class="nav nav-sm flex-column">
                            {{-- Comments --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.comments.index') }}" class="nav-link"
                                    data-key="t-horizontal">Comment</a>

                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
