<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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


        /* css chi tiết sản phẩm */
        .product-detail {
            padding: 20px 0;
        }

        .product-images {
            text-align: center;
        }

        .main-image {
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
        }

        .image-thumbnails img {
            width: 80px;
            height: 80px;
            margin-right: 10px;
            cursor: pointer;
        }

        .product-info h2 {
            font-size: 28px;
            font-weight: bold;
        }

        .product-price {
            color: red;
            font-size: 24px;
            font-weight: bold;
        }

        .product-size button {
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .quantity {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .quantity button {
            width: 40px;
        }

        .quantity input {
            width: 50px;
            text-align: center;
            margin: 0 10px;
        }

        .purchase-buttons button {
            width: 100%;
            margin-bottom: 10px;

            color: #000;
            border-radius: 50px;
            padding: 5px 15px;

        }

        .social-icons img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
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
                <a class="navbar-brand" href="#"><img src="https://kingshoes.vn/Content/Frontend/images/logo/logo-white.png" alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <input class="form-control mr-sm-2" type="search" placeholder="Nhập từ cần tìm" aria-label="Search">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <a class="nav-link cart-icon ml-3" href="#"><i class="fas fa-shopping-cart"></i> <span class="badge badge-light">0</span></a>
                    <a class="btn btn-contact ml-3" href="#">Đăng Nhập</a>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <!-- <section class="hero-section text-center text-white position-relative py-5">
            <div style="width: 100%;">

                <img src="/css/trang-chu/img/banner-nike.jpg" alt="Banner Adidas" class="img-fluid w-100">
            </div>
            <div class="overlay d-flex align-items-center justify-content-center">
                <div class="content">
                    <h1>Chào mừng đến với FF</h1>
                    <p>Địa chỉ tin cậy cho các loại giày thể thao chính hãng</p>
                </div>
            </div>
        </section> -->

        <!-- <section class="commitment-section text-center py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="commitment-item">
                            <img src="path/to/authentic-icon.png" alt="" class="img-fluid">
                            <h3 class="mt-3">CAM KẾT CHÍNH HÃNG</h3>
                            <p>100 % Authentic</p>
                            <p>Cam kết sản phẩm chính hãng từ Châu Âu, Châu Mỹ...</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="commitment-item">
                            <img src="path/to/express-delivery-icon.png" alt="" class="img-fluid">
                            <h3 class="mt-3">GIAO HÀNG HỎA TỐC</h3>
                            <p>Express delivery</p>
                            <p>SHIP hỏa tốc 1h nhận hàng trong nội thành Hà Nội</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="commitment-item">
                            <img src="path/to/support-icon.png" alt="" class="img-fluid">
                            <h3 class="mt-3">HỖ TRỢ 24/24</h3>
                            <p>Supporting 24/24</p>
                            <p>Gọi ngay 099999999</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <section class="product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 product-images">
                        <img src="/css/trang-chu/img/img_nike.png" alt="Product Main Image" class="main-image">
                        <div class="image-thumbnails">
                            <img src="/css/trang-chu/img/img_nike.png" alt="Thumbnail 1">
                            <img src="/css/trang-chu/img/img_nike_ải.png" alt="Thumbnail 2">
                            <img src="/css/trang-chu/img/img_nike.png" alt="Thumbnail 1">
                            <img src="/css/trang-chu/img/img_nike_ải.png" alt="Thumbnail 2">
                        </div>
                    </div>
                    <div class="col-md-6 product-info">
                        <h2>NIKE AIR FOR ONE</h2>
                        <p>Mã SP: PH30833</p>
                        <p class="product-price">2,900,000 đ</p>
                        <div class="product-size .rounded-pill">
                            <button class="btn btn-outline-secondary ">40</button>
                            <button class="btn btn-outline-secondary">40.5</button>
                            <button class="btn btn-outline-secondary">41</button>
                            <button class="btn btn-outline-secondary">42</button>
                            <button class="btn btn-outline-secondary">43</button>
                            <button class="btn btn-outline-secondary">44</button>
                            <button class="btn btn-outline-secondary">45</button>
                        </div>
                        <div class="quantity">
                            <button class="btn btn-outline-secondary">-</button>
                            <input type="text" value="1" size="2">
                            <button class="btn btn-outline-secondary">+</button>
                        </div>
                        <div class="purchase-buttons">
                            <button class="btn btn-warning btn-cart">THÊM VÀO GIỎ</button>
                            <button class="btn btn-danger btn-buy">MUA NGAY</button>
                        </div>
                        <p class="contact-info">Hoặc đặt mua: 0999999999 (Tư vấn Miễn phí)</p>
                        <!-- <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-pinterest"></i></a>
                            <a href="#"><i class="fab fa-zalo"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <h3 class="mt-5 text-center">SẢN PHẨM TƯƠNG TỰ</h3>
            <div class="row">
                <!-- Product 1 -->
                <div class="col-md-3 py-3">
                    <a href="product-details-1.html" class="product-link">
                        <div class="card shadow-sm position-relative">
                            <div class="sale-badge">50% OFF</div>
                            <img src="/css/trang-chu/img/img_nike_ải.png" class="card-img-top" alt="Product Image">
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
                            <img src="/css/trang-chu/img/img_nike.png" class="card-img-top" alt="Product Image">
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
                            <img src="/css/trang-chu/img/img_nike_ải.png" class="card-img-top" alt="Product Image">
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
                            <img src="/css/trang-chu/img/img_nike.png" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title">Sản phẩm 1</h5>
                                <p class="card-text text-danger">$60</p>
                            </div>
                        </div>
                    </a>
                </div>



            </div>
        </div>
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
</body>

</html>
