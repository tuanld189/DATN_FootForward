<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <h3 class="text-white m-2">FOOTFORWARD</h3>
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
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}">
                        <i class="ri-home-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCategories">
                        <i class="ri-store-2-line"></i> <span data-key="t-layouts">Quản lí Sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.brands.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-price-tag-3-line"></i> Hãng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-folder-3-line"></i> Danh mục
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-shopping-basket-line"></i> Sản phẩm
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sales.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-arrow-up-line"></i> Khuyễn mại
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarorders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarorders">
                        <i class="ri-shopping-basket-line"></i> <span data-key="t-layouts">Quản lí Đơn hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarorders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-shopping-basket-line"></i> Đơn hàng
                                </a>
                                <a href="{{ route('admin.orders.status') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-checkbox-circle-line"></i> Trang thái đơn hàng
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPosts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPosts">
                        <i class="ri-notification-line"></i> <span data-key="t-layouts">Quản lí Bài viết</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPosts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.posts.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-edit-box-line"></i> Bài viết
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarComment" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarComment">
                        <i class="ri-discuss-line"></i> <span data-key="t-layouts">Quản lí Bình luận</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarComment">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.comments.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-discuss-line"></i> Bình luận
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarVouchers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarVouchers">
                        <i class="ri-price-tag-2-line"></i> <span data-key="t-layouts">Quản lí mã giảm giá</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarVouchers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.vourchers.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-price-tag-2-line"></i> Mã giảm giá
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBanners" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBanners">
                        <i class="ri-image-line"></i> <span data-key="t-layouts">Quản lí Banner</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBanners">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.banners.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-image-line"></i> Banners
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarusers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarusers">
                        <i class="ri-user-3-line"></i> <span data-key="t-layouts">Quản lí Người dùng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarusers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-lock-line"></i> Quyền
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-shield-check-line"></i> Vai trò
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-user-line"></i> Người dùng
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end users Menu -->

            </ul>
        </div>
    </div>
</div>
