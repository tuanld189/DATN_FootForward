<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="Logo" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="Logo" height="17">
            </span>
        </a>
        <!-- Light Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="Logo" height="22">
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
                    <a class="nav-link menu-link" href="#sidebarDashboard" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboard">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-layouts">Dashboards</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboard">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-home-2-line"></i> Tổng quan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard.RevenueDetail', ['filter' => 'this_week']) }}" class="nav-link" data-key="t-horizontal">
                                    <i class="fa-solid fa-thumbtack"></i> Thống kê doanh thu
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard.OrderDetail', ['filter' => 'this_week']) }}" class="nav-link" data-key="t-horizontal">
                                    <i class="fa-solid fa-cart-plus"></i> Thống kê đơn hàng
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCategories">
                        <i class="ri-store-2-line"></i> <span data-key="t-layouts">Quản lý Sản phẩm</span>
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
                                    <i class="ri-arrow-up-line"></i> Khuyến mại
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarorders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarorders">
                        <i class="ri-shopping-basket-line"></i> <span data-key="t-layouts">Quản lý Đơn hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarorders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-shopping-basket-line"></i> Đơn hàng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.status') }}" class="nav-link" data-key="t-horizontal">
                                    <i class="ri-checkbox-circle-line"></i> Trạng thái đơn hàng
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.posts.index') }}">
                        <i class="ri-edit-box-line"></i> <span data-key="t-layouts">Quản lý Bài viết</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.comments.index') }}">
                        <i class="ri-discuss-line"></i> <span data-key="t-layouts">Quản lý Bình luận</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.vourchers.index') }}">
                        <i class="ri-price-tag-2-line"></i> <span data-key="t-layouts">Quản lý Mã giảm giá</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.banners.index') }}">
                        <i class="ri-image-line"></i> <span data-key="t-layouts">Quản lý Banner</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarusers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarusers">
                        <i class="ri-user-3-line"></i> <span data-key="t-layouts">Quản lý Người dùng</span>
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
