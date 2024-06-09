<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FootForward</title>
    <!-- Latest compiled and minified CSS -->
    <title>Shoes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <div class="header-top">
        <div class="container">
            <div class="d-flex justify-content-end align-items-center">
                <div class="contact-info">
                    <span>Shoes</span>
                    <a href="#">Check User</a>
                    <a href="#">Hotline: 0999999999</a>
                </div>
            </div>
        </div>
    </div>

    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><h6>FF</h6></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#">Giới thiệu</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Nike</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Adidas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Jordan</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Yeezy</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Other Brands</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Sale</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Dây Giày</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Spa Giày</a></li>
                    </ul>
                    <form class="search-form form-inline my-2 my-lg-0 ml-3">
                        <input class="form-control mr-sm-2" type="search" placeholder="Nhập từ cần tìm"
                            aria-label="Search">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <a class="nav-link cart-icon ml-3" href="#"><i class="fas fa-shopping-cart"></i> <span
                            class="badge badge-light">0</span></a>
                    <a class="btn btn-contact ml-3" href="#">Đăng Nhập</a>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <section class="hero-section text-center text-white position-relative py-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/banner-nike.jpg') }}" class="d-block w-100" alt="First Slide">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/banner-adidas.jpg') }}" class="d-block w-100" alt="Second Slide">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/banner-nike.jpg') }}" class="d-block w-100" alt="Third Slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="overlay d-flex align-items-center justify-content-center">
                <div class="content">
                    <h1>Chào mừng đến với FootForward</h1>
                    <p>Địa chỉ tin cậy cho các loại giày thể thao chính hãng</p>
                </div>
            </div>
        </section>
<br><br>
        <section class="commitment-section text-center py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="commitment-item">
                            <img src="{{asset('images/icons/authentic-icon.png')}}" width="100px" height="100px" alt="" class="img-fluid">
                            <h3 class="mt-3">CAM KẾT CHÍNH HÃNG</h3>
                            <p>100 % Authentic</p>
                            <p>Cam kết sản phẩm chính hãng từ Châu Âu, Châu Mỹ...</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="commitment-item">
                            <img src="{{asset('images/icons/express-delivery-icons.png')}}" width="100px" height="100px" alt="" class="img-fluid">
                            <h3 class="mt-3">GIAO HÀNG HỎA TỐC</h3>
                            <p>Express delivery</p>
                            <p>SHIP hỏa tốc 1h nhận hàng trong nội thành Hà Nội</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="commitment-item">
                            <img src="{{asset('images/icons/support-icon.png')}}" alt="" class="img-fluid">
                            <h3 class="mt-3">HỖ TRỢ 24/24</h3>
                            <p>Supporting 24/24</p>
                            <p>Gọi ngay 099999999</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="product-section py-5">
            <div class="container">
                <h3 class="mt-3">SẢN PHẨM MỚI</h3>
                <div class="row">



                    <div class="col-md-3 py-3">
                        <div class="card shadow-sm">
                            <a href="{{asset('product_detail')}}" class="product-link">
                                <img src="{{ asset('images/img_nike.png') }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản Phẩm 1</h5>
                                    <p class="card-text text-danger">$50</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 py-3">
                        <div class="card shadow-sm">
                            <a href="{{asset('product_detail')}}" class="product-link">
                                <img src="{{ asset('images/img_nike_01.png') }}" class="card-img-top"
                                    alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 2</h5>
                                    <p class="card-text text-danger">$60</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 py-3">
                        <div class="card shadow-sm">
                            <a href="product-details-1.html" class="product-link">
                                <img src="{{ asset('images/img_nike.png') }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản Phẩm 1</h5>
                                    <p class="card-text text-danger">$50</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 py-3">
                        <div class="card shadow-sm">
                            <a href="product-details-2.html" class="product-link">
                                <img src="{{ asset('images/img_nike_01.png') }}" class="card-img-top"
                                    alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 2</h5>
                                    <p class="card-text text-danger">$60</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h3 class="mt-5">SẢN PHẨM NỔI BẬT</h3>
                <div class="row">
                    <!-- Product 1 -->
                    <div class="col-md-3 py-3">
                        <div class="card shadow-sm">
                            <a href="product-details-1.html" class="product-link">
                                <img src="{{ asset('images/img_nike.png') }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản Phẩm 1</h5>
                                    <p class="card-text text-danger">$50</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 py-3">
                        <div class="card shadow-sm">
                            <a href="product-details-2.html" class="product-link">
                                <img src="{{ asset('images/img_nike_01.png') }}" class="card-img-top"
                                    alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 2</h5>
                                    <p class="card-text text-danger">$60</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 py-3">
                        <div class="card shadow-sm">
                            <a href="product-details-1.html" class="product-link">
                                <img src="{{ asset('images/img_nike.png') }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản Phẩm 1</h5>
                                    <p class="card-text text-danger">$50</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 py-3">
                        <div class="card shadow-sm">
                            <a href="product-details-2.html" class="product-link">
                                <img src="{{ asset('images/img_nike_01.png') }}" class="card-img-top"
                                    alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 2</h5>
                                    <p class="card-text text-danger">$60</p>
                                </div>
                            </a>
                        </div>
                    </div>



                </div>
            </div>

            <div class="container">
                <h3 class="mt-5">SẢN PHẨM KHUYẾN MÃI</h3>
                <div class="row">
                    <!-- Product 1 -->
                    <div class="col-md-3 py-3">
                        <a href="product-details-1.html" class="product-link">
                            <div class="card shadow-sm position-relative">
                                <div class="sale-badge">50% OFF</div>
                                <img src="{{ asset('images/img_nike_01.png') }}" class="card-img-top"
                                    alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 1</h5>
                                    <p class="card-text text-danger">$60</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 2 -->
                    <div class="col-md-3 py-3">
                        <a href="product-details-1.html" class="product-link">
                            <div class="card shadow-sm position-relative">
                                <div class="sale-badge">50% OFF</div>
                                <img src="{{ asset('images/img_nike.png') }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 1</h5>
                                    <p class="card-text text-danger">$60</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 py-3">
                        <a href="product-details-1.html" class="product-link">
                            <div class="card shadow-sm position-relative">
                                <div class="sale-badge">50% OFF</div>
                                <img src="{{ asset('images/img_nike_01.png') }}" class="card-img-top"
                                    alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 1</h5>
                                    <p class="card-text text-danger">$60</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 py-3">
                        <a href="product-details-1.html" class="product-link">
                            <div class="card shadow-sm position-relative">
                                <div class="sale-badge">50% OFF</div>
                                <img src="{{ asset('images/img_nike.png') }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 1</h5>
                                    <p class="card-text text-danger">$60</p>
                                </div>
                            </div>
                        </a>
                    </div>



                </div>
            </div>

            <div class="container">
                <h3 class="mt-5">TIN TỨC MỚI</h3>
                <div class="row">
                    <!-- News Item 1 -->
                    <div class="col-md-6 py-3">
                        <a href="#" class="news-link">
                            <div class="d-flex align-items-center border shadow-sm p-3" style="height: 100%;">
                                <div class="flex-grow-1">
                                    <h5 class="card-title">TPHCM MUA GIÀY THỂ THAO ADIDAS. NIKE CHÍNH HÃNG Ở ĐÂU? ĐẾN
                                        KING...</h5>
                                    <p class="card-text"><strong>TPHCM&nbsp;mua giày chạy bộ thể thao adidas/ nike
                                            chính hãng ở đâu?</strong> đến <strong>KING SHOES</strong>...</p>
                                    <p class="card-link text-primary">XEM THÊM →</p>
                                </div>
                                <div class="ml-3">
                                    <img src="{{ asset('images/img_nike_01.png') }}" class="img-fluid"
                                        alt="News Image 1" style="width: 200px; height: auto;">
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- News Item 2 -->
                    <div class="col-md-6 py-3">
                        <a href="#" class="news-link">
                            <div class="d-flex align-items-center border shadow-sm p-3" style="height: 100%;">
                                <div class="flex-grow-1">
                                    <h5 class="card-title">DANH SÁCH CỬA HÀNG GIÀY THỂ THAO NAM/ NỮ HOT NHẤT TPHCM</h5>
                                    <p class="card-text">Khám phá cửa hàng giày thể thao nam/ nữ HOT nhất TP.HCM hàng
                                        trăm mẫu MỚI NHẤT - HOT NHẤT sẵn tại cửa hàng KING SHOES...</p>
                                    <p class="card-link text-primary">XEM THÊM →</p>
                                </div>
                                <div class="ml-3">
                                    <img src="{{ asset('images/img_nike.png') }}" class="img-fluid" alt="News Image 2"
                                        style="width: 200px; height: auto;">
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 py-3">
                        <a href="#" class="news-link">
                            <div class="d-flex align-items-center border shadow-sm p-3" style="height: 100%;">
                                <div class="flex-grow-1">
                                    <h5 class="card-title">TPHCM MUA GIÀY THỂ THAO ADIDAS. NIKE CHÍNH HÃNG Ở ĐÂU? ĐẾN
                                        KING...</h5>
                                    <p class="card-text"><strong>TPHCM&nbsp;mua giày chạy bộ thể thao adidas/ nike
                                            chính hãng ở đâu?</strong> đến <strong>KING SHOES</strong>...</p>
                                    <p class="card-link text-primary">XEM THÊM →</p>
                                </div>
                                <div class="ml-3">
                                    <img src="{{ asset('images/img_nike_01.png') }}" class="img-fluid"
                                        alt="News Image 1" style="width: 200px; height: auto;">
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- News Item 2 -->
                    <div class="col-md-6 py-3">
                        <a href="#" class="news-link">
                            <div class="d-flex align-items-center border shadow-sm p-3" style="height: 100%;">
                                <div class="flex-grow-1">
                                    <h5 class="card-title">DANH SÁCH CỬA HÀNG GIÀY THỂ THAO NAM/ NỮ HOT NHẤT TPHCM</h5>
                                    <p class="card-text">Khám phá cửa hàng giày thể thao nam/ nữ HOT nhất TP.HCM hàng
                                        trăm mẫu MỚI NHẤT - HOT NHẤT sẵn tại cửa hàng KING SHOES...</p>
                                    <p class="card-link text-primary">XEM THÊM →</p>
                                </div>
                                <div class="ml-3">
                                    <img src="{{ asset('images/img_nike.png') }}" class="img-fluid" alt="News Image 2"
                                        style="width: 200px; height: auto;">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


        </section>

    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>King Shoes</h5>
                    <ul>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Điều khoản dịch vụ</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Sản phẩm</h5>
                    <ul>
                        <li><a href="#">Nike</a></li>
                        <li><a href="#">Adidas</a></li>
                        <li><a href="#">Jordan</a></li>
                        <li><a href="#">Yeezy</a></li>
                        <li><a href="#">Dây Giày</a></li>
                        <li><a href="#">Spa Giày</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Hỗ trợ khách hàng</h5>
                    <ul>
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Chính sách bảo hành</a></li>
                        <li><a href="#">Chính sách vận chuyển</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Kết nối với chúng tôi</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- CSS --}}
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }

        .header-top {
            background-color: #f8f9fa;
            padding: 5px 0;
            font-size: 14px;
        }

        .header-top .contact-info {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .header-top .contact-info a {
            color: #000;
            margin-left: 15px;
            text-decoration: none;
        }

        .header-top .contact-info a:hover {
            text-decoration: underline;
        }

        .header {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .navbar-brand img {
            width: 120px;
        }

        .navbar-nav .nav-link {
            color: #000;
            font-weight: bold;
            text-transform: uppercase;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107;
        }

        .navbar .search-form {
            position: relative;
        }

        .navbar .search-form input {
            border-radius: 50px;
            padding-left: 30px;
        }

        .navbar .search-form button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #000;
        }

        .navbar .cart-icon {
            font-size: 24px;
            position: relative;
        }

        .navbar .cart-icon .badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background: #ffc107;
            color: #000;
        }

        .navbar .btn-contact {
            background-color: #ffc107;
            color: #000;
            border-radius: 50px;
            padding: 5px 15px;
            font-weight: bold;
        }

        .navbar .btn-contact:hover {
            background-color: #e0a800;
        }

        .hero-section {
            background-color: #000;
            padding: 100px 0;
        }

        .hero-section h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 18px;
        }

        .product-section {
            background-color: #f8f9fa;
            padding: 50px 0;
        }

        .promo-banner {
            background-color: #ffc107;
            padding: 50px 0;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 50px 0;
        }

        .footer h5 {
            color: #ffc107;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 10px;
        }

        .footer ul li a {
            color: #fff;
            text-decoration: none;
        }

        .footer ul li a:hover {
            color: #ffc107;
        }

        .social-icons a {
            margin-right: 10px;
            color: #fff;
            font-size: 24px;
        }

        .social-icons a:hover {
            color: #ffc107;
        }

        .product-link {
            text-decoration: none;
            color: #000;
        }

        .product-link:hover {
            color: #007bff;
            text-decoration: none;
        }

        .card:hover {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
            transition: all 0.2s ease;
        }

        .sale-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: red;
            color: white;
            padding: 5px 10px;
            font-size: 0.8em;
            font-weight: bold;
            border-radius: 5px;
        }

        .hero-section {
            position: relative;
            height: 100vh;
        }

        .hero-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay .content {
            text-align: center;
            padding: 20px;
        }

        .overlay h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .overlay p {
            font-size: 1.25rem;
            margin-bottom: 0;
        }

        .commitment-section {
            background-color: #f0f0f0;
            padding: 50px 0;
        }

        .commitment-item {
            text-align: center;
        }

        .commitment-item img {
            max-width: 50px;
        }

        .commitment-item h3 {
            color: #ffcc00;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        .commitment-item p {
            color: #333;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>

</body>

</html>
