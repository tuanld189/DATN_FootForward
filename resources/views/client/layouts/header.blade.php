<div class="header-area">
    <div class="header-top bg-black">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-2 order-lg-1">
                    <div class="top-left-wrap">
                        <ul class="phone-email-wrap">
                            <li><i class="fa fa-phone"></i> (+84)0968888888</li>
                            <li><i class="fa fa-envelope-open-o"></i> wk@footforward.vn</li>
                        </ul>
                        <ul class="link-top">
                            <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" title="Rss"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#" title="Google"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" title="Youtube"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 order-1 order-lg-2">
                    <div class="top-selector-wrapper">
                        <ul class="single-top-selector">
                            <li class="currency list-inline-item">
                                <div class="btn-group">
                                    <button class="dropdown-toggle"> VNĐ ₫<i class="fa fa-angle-down"></i></button>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a href="#">Euro €</a></li>
                                            <li><a href="#" class="current">USD $</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="language list-inline-item">
                                <div class="btn-group">
                                    <button class="dropdown-toggle"><img src="assets/images/icon/vn.png" width="20px"
                                            height="20px" alt=""> Tiếng Việt <i
                                            class="fa fa-angle-down"></i></button>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a href="#"><img src="assets/images/icon/la-1.jpg" alt="">
                                                    English</a></li>
                                            <li><a href="#"><img src="assets/images/icon/la-2.jpg" alt="">
                                                    Français</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="setting-top list-inline-item">
                                <div class="btn-group">
                                    <button class="dropdown-toggle">
                                        <i class="">
                                            <img alt="user avatar"
                                                src="{{ Auth::check() ? Storage::url(Auth::user()->photo_thumbs) : asset('assets/images/banner/Avatardf.jpg') }}"
                                                style="border-radius: 100%; height:25px; width:25px; "></i>{{ Auth::check() ? Auth::user()->name : 'Setting' }}
                                        <i class="fa fa-angle-down">
                                        </i>
                                    </button>

                                    <div class="dropdown-menu">
                                        <ul>
                                            @if (Auth::check())
                                                <li>
                                                    <a
                                                        href="{{ route('client.profile.edit', ['id' => Auth::user()->id]) }}">Tài
                                                        khoản</a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('client.profile.edit', ['id' => Auth::user()->id]) }}">Đơn
                                                        mua</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.dashboard') }}">Quản lý</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('login') }}">Đăng kí</a>
                                                </li>
                                            @endif


                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom-area header-sticky" style="height: 100px;">
        <div class="container">
            <div class="header-content d-flex justify-content-between align-items-center" style="height: 100px;">
                <div class="logo" style="margin-left:20px;">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('assets/images/logo-shoes.png') }}" alt="" width="80px"
                            height="80px">
                    </a>
                </div>
                <div class="main-menu-area">
                    <nav class="main-navigation">
                        <ul class="d-flex justify-content-center">
                            <li class="active"><a href="{{ route('index') }}">Trang chủ</a></li>
                            <li><a href="{{ route('shop') }}">Sản phẩm
                                    {{-- <i class="fa fa-angle-down"></i> --}}
                                </a>
                                {{-- <ul class="mega-menu">
                                    <li><a href="#"><b>THỂ LOẠI</b></a>
                                        <ul>
                                            <li><a href="shop-3-col.html">Giày chạy bộ</a></li>
                                            <li><a href="shop-4-col.html">Giày lifestyle</a></li>
                                            <li><a href="shop.html">Giày trending </a></li>
                                            <li><a href="shop-right-sidebar.html">Giày thể theo</a></li>

                                        </ul>
                                    </li>
                                    <li style="margin-left:60px;"><a href="#"><b>THƯƠNG HIỆU</b></a>
                                        <ul>
                                            <li><a href="product-details.html">Adidas</a></li>
                                            <li><a href="product-details-group.html">Nike</a></li>
                                            <li><a href="product-details-normal.html">JorDan</a></li>
                                            <li><a href="product-details-affiliate.html">New Balance</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> --}}
                            </li>
                            <li><a href="{{ route('client.new') }}">Bài viết</i></a></li>
                            <li><a href="{{ route('client.info') }}">Thông tin </a></li>
                            <li><a href="{{ route('client.info') }}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header-bottom-right d-flex justify-content-end">
                    <div class="block-search">
                        <div class="trigger-search">
                            <i class="fa fa-search"></i> <span>Tìm kiếm</span>
                        </div>
                        <div class="search-box main-search-active">
                            <form action="#" class="search-box-inner">
                                <input type="text" placeholder="Search our catalog">
                                <button class="search-btn" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="shoping-cart">
                        <div class="btn-group">
                            <button class="dropdown-toggle">
                                @php
                                    $totalItems = count(session('cart', []));
                                @endphp
                                <a href="{{ route('cart.list') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
                                ({{ $totalItems }})
                            </button>
                            <div class="dropdown-menu mini-cart-wrap mt-4"
                                style="overflow-y:scroll; width:350px; height: 350px; background-color: white;">
                                <div class="shopping-cart-content">
                                    <ul class="mini-cart-content">
                                        @php
                                            $totalAmount = 0;
                                        @endphp
                                        @forelse(session('cart', []) as $item)
                                            @php
                                                $itemTotal =
                                                    $item['quantity_add'] * ($item['sale_price'] ?: $item['price']);
                                                $totalAmount += $itemTotal;
                                            @endphp
                                            <li class="mini-cart-item">
                                                <div class="mini-cart-product-img">
                                                    <a href="#"> <img
                                                            src="{{ asset('storage/' . $item['image']) }}"
                                                            alt="" width="70px"></a>
                                                    <span class="product-quantity">x{{ $item['quantity_add'] }}</span>
                                                </div>
                                                <div class="mini-cart-product-desc ">
                                                    <h3><a href="#">{{ $item['name'] }}</a></h3>
                                                    <div class="price-box">
                                                        @if ($item['sale_price'])
                                                            <span
                                                                class="amount old-price">{{ number_format($item['price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                            <span
                                                                class="amount new-price">{{ number_format($item['sale_price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @else
                                                            <span
                                                                class="amount">{{ number_format($item['price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @endif
                                                    </div>
                                                    <div class="size">Size: {{ $item['size']['name'] }}</div>
                                                    <div class="color">Color: {{ $item['color']['name'] }}</div>
                                                </div>
                                                <div class="remove-from-cart " style="margin-left:30px;">
                                                    <form action="{{ route('cart.remove', ['id' => $item['id']]) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure?')" title="Remove"
                                                            style="background:none; border:none; color: inherit;">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </li>
                                        @empty
                                            <li>
                                                <div class="shopping-cart-content text-center" colspan="8"
                                                    style="height:150px;">No items in the cart</div>
                                            </li>
                                        @endforelse

                                        <li>
                                            <div class="shopping-cart-total">
                                                <h4>Sub-Total : <span>{{ number_format($totalAmount, 0, ',', '.') }}
                                                        VNĐ</span></h4>
                                            </div>
                                            <div class="shopping-cart-total">
                                                <h4>Total : <span>{{ number_format($totalAmount, 0, ',', '.') }}
                                                        VNĐ</span></h4>
                                            </div>
                                            <div class="shopping-cart-btn">
                                                <a href="{{ route('cart.list') }}">Chi tiết</a>
                                                <a href="{{ route('cart.checkout') }}">Thanh toán</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
