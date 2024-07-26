
<!-- header-area start -->
<div class="header-area">
    <!-- header-top start -->
    <div class="header-top bg-black">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-2 order-lg-1">
                    <div class="top-left-wrap">
                        <ul class="phone-email-wrap">
                            <li><i class="fa fa-phone"></i> (08)123 456 7890</li>
                            <li><i class="fa fa-envelope-open-o"></i> yourmail@domain.com</li>
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
                            <!-- Currency Start -->
                            <li class="currency list-inline-item">
                                <div class="btn-group">
                                    <button class="dropdown-toggle"> USD $ <i class="fa fa-angle-down"></i></button>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a href="#">Euro €</a></li>
                                            <li><a href="#" class="current">USD $</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Currency End -->
                            <!-- Language Start -->
                            <li class="language list-inline-item">
                                <div class="btn-group">
                                    <button class="dropdown-toggle"><img src="assets/images/icon/la-1.jpg"
                                            alt=""> English <i class="fa fa-angle-down"></i></button>
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
                            <!-- Language End -->
                            <!-- Sanguage Start -->
                            <li class="setting-top list-inline-item">
                                <div class="btn-group">
                                    <button class="dropdown-toggle"><i class=""><img alt="user avatar"
                                        src="{{ Storage::url(Auth::check() ? Auth::user()->photo_thumbs : asset('assets/images/banner/Avatardf.jpg') ) }}" width="20px"
                                        height="30px" style="border-radius: 100%;"></i>{{ Auth::check() ? Auth::user()->name: 'Setting' }} <i class="fa fa-angle-down"></i></button>

                                    <div class="dropdown-menu">
                                        <ul>
                                            <li>
                                                @if (Auth::check())
                                                    <a href="{{ route('client.profile.edit', ['id' => Auth::user()->id]) }}">My account</a>
                                                @else
                                                    <a href="#">My account</a> <!-- hoặc thêm liên kết mặc định hoặc thông báo lỗi -->
                                                @endif
                                            </li>

                                            <li><a href="checkout.html">Checkout</a></li>
                                            @if (Auth::check())
                                                    <li><a href="{{route('admin.dashboard')}}">Admin</a></li>

                                            @endif
                                            <li><a href="{{route('login')}}">Login</a></li>



                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Sanguage End -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header-top end -->
    <!-- Header-bottom start -->
    <div class="header-bottom-area header-sticky">
        <div class="container">
            <div class="header-content d-flex justify-content-between align-items-center">
                <!-- logo start -->
                <div class="logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('assets/images/logo-shoes.png') }}" alt="" width="80px"
                            height="80px">
                    </a>
                </div>
                <!-- logo end -->

                <!-- main-menu-area start -->
                <div class="main-menu-area">
                    <nav class="main-navigation">
                        <ul class="d-flex justify-content-center">
                            <li class="active"><a href="{{ route('index') }}">Home</a></li>
                            <li><a href="{{route('shop')}}">Shop <i class="fa fa-angle-down"></i></a>
                                <ul class="mega-menu">
                                    <li><a href="#">Shop PageLayout</a>
                                        <ul>
                                            <li><a href="shop-3-col.html">Shop 3 Column</a></li>
                                            <li><a href="shop-4-col.html">Shop 4 Column</a></li>
                                            <li><a href="shop.html">Shop Left Sidebar</a></li>
                                            <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                            <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                                            <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                                            <li><a href="shop-list-fullwidth.html">Shop Lsiting View</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Single Products</a>
                                        <ul>
                                            <li><a href="product-details.html">Single Product</a></li>
                                            <li><a href="product-details-group.html">Single Product Group</a></li>
                                            <li><a href="product-details-normal.html">Single Product Normal</a></li>
                                            <li><a href="product-details-affiliate.html">Single Product Affiliate</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="shop.html">Page <i class="fa fa-angle-down"></i></a>
                                <ul class="mega-menu four-column-menu">
                                    <li><a href="#">Column One</a>
                                        <ul>
                                            <li><a href="compare.html">Compare Page</a></li>
                                            <li><a href="login-register.html">Login &amp; Register</a></li>
                                            <li><a href="my-account.html">My Account Page</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="blog.html">Column two</a>
                                        <ul>
                                            <li><a href="cart.html">Cart Page</a></li>
                                            <li><a href="checkout.html">Checkout Page</a></li>
                                            <li><a href="wishlist.html">Wishlist Page</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="blog.html">Blog</i></a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="contact-us.html">Contact us</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- main-menu-area end -->

                <!-- header-right start -->
                <div class="header-bottom-right d-flex justify-content-end">
                    <div class="block-search">
                        <div class="trigger-search">
                            <i class="fa fa-search"></i> <span>Search</span>
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
                            <!-- Mini Cart Button start -->
                            <button class="dropdown-toggle">
                                @php
                                    $totalItems = count(session('cart', []));
                                @endphp
                                <i class="fa fa-shopping-cart"></i> Cart ({{$totalItems}})
                            </button>
                            <!-- Mini Cart button end -->

                            <!-- Mini Cart wrap start -->
                            <div class="dropdown-menu mini-cart-wrap mt-4" style="overflow-y:scroll; width:350px; height: 350px; background-color: white;">
                                <div class="shopping-cart-content">
                                    <ul class="mini-cart-content">
                                        @php
                                            $totalAmount = 0; // Khởi tạo tổng số tiền
                                        @endphp
                                        @forelse(session('cart', []) as $item)
                                            @php
                                                $itemTotal = $item['quantity_add'] * ($item['sale_price'] ?: $item['price']);
                                                $totalAmount += $itemTotal;
                                            @endphp
                                            <!-- Mini-Cart-item start -->
                                            <li class="mini-cart-item">
                                                <div class="mini-cart-product-img">
                                                    <a href="#"> <img src="{{ asset('storage/' . $item['image']) }}" alt="" width="70px"></a>
                                                    <span class="product-quantity">x{{ $item['quantity_add'] }}</span>
                                                </div>
                                                <div class="mini-cart-product-desc">
                                                    <h3><a href="#">{{ $item['name'] }}</a></h3>
                                                    <div class="price-box">
                                                        @if ($item['sale_price'])
                                                            <span class="amount old-price">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</span>
                                                            <span class="amount new-price">{{ number_format($item['sale_price'], 0, ',', '.') }} VNĐ</span>
                                                        @else
                                                            <span class="amount">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</span>
                                                        @endif
                                                    </div>
                                                    <div class="size">Size: {{ $item['size']['name'] }}</div>
                                                    <div class="color">Color: {{ $item['color']['name'] }}</div>
                                                </div>
                                                <div class="remove-from-cart " style="margin-left:30px;">
                                                    <form action="{{ route('cart.remove', ['id' => $item['id']]) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure?')" title="Remove" style="background:none; border:none; color: inherit;">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </li>
                                        @empty
                                            <li>
                                                <div class="shopping-cart-content text-center" colspan="8" style="height:150px;" >No items in the cart</div>
                                            </li>
                                        @endforelse

                                        <li>
                                            <!-- shopping-cart-total start -->
                                            <div class="shopping-cart-total">
                                                <h4>Sub-Total : <span>{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</span></h4>
                                                <!-- Include other total calculations here if needed -->
                                            </div>
                                            <div class="shopping-cart-total">
                                                <h4>Total : <span>{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</span></h4>
                                                <!-- Include other total calculations here if needed -->
                                            </div>
                                            <div class="shopping-cart-btn">
                                                <a href="{{ route('cart.list') }}">Detail</a>
                                                <a href="{{ route('cart.checkout') }}">Checkout</a>
                                            </div>
                                            <!-- shopping-cart-btn end -->
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <!-- Mini Cart wrap End -->
                        </div>
                    </div>
                </div>
                <!-- header-right end -->
            </div>
        </div>
    </div>
</div>
