@extends('client.layouts.master')
@section('title', 'Thông tin cửa hàng')
@section('styles')
<style>
    .store-info-area {
        padding-top: 50px;
        padding-bottom: 50px;
    }
    .single-store-info {
        display: flex;
        flex-direction: column;
        margin-bottom: 30px;
    }
    .store-image {
        display: flex;
        justify-content: center;
    }
    .store-image img {
        width: 150px;
        height: auto;
        max-height: 200px;
        object-fit: cover;
    }
    .store-content {
        padding: 20px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .store-content h4 {
        margin-top: 0;
    }
    .store-content .store_meta {
        margin: 10px 0;
        color: #777;
        font-size: 14px;
    }
    .store-content p {
        margin: 10px 0;
    }
    .map-container {
        width: 100%;
        height: 600px;
        margin-top: 30px;
    }
</style>
@endsection
@section('content')

<div class="store-info-area section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title section-bg-3">
                    <h2>Thông tin cửa hàng</h2>
                    <p>Cửa hàng giày FootForward</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="single-store-info mt--30">
                    <div class="store-image">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('assets/images/logo-shoes.png') }}" alt="FootForward Store">
                        </a>
                    </div>
                    <div class="store-content">
                        <h4>FootForward Store</h4>
                        <div class="store_meta">
                            <span class="meta_location">
                                <i class="fa fa-map-marker"></i> Số 1 Trịnh Văn Bô, Nam Từ Liêm, Hà Nội
                            </span>
                            <br>
                            <span class="meta_phone">
                                <i class="fa fa-phone"></i>  (+84)0987 456 321
                            </span><br>
                            <span class="meta_email">
                                <i class="fa fa-envelope"></i> wk@footforward.vn
                            </span><br>
                            <span class="meta_hours">
                                <i class="fa fa-clock"></i> Giờ làm việc: 24/7 (Tất cả các ngày trong tuần)
                            </span><br>
                        </div>
                        <p>FootForward là cửa hàng giày uy tín tại Hà Nội, chuyên cung cấp các loại giày thể thao chất lượng cao. Với đội ngũ nhân viên chuyên nghiệp và nhiệt tình, chúng tôi cam kết mang đến cho khách hàng những sản phẩm tốt nhất và dịch vụ chăm sóc khách hàng hoàn hảo.</p>
                        <p>Chúng tôi cung cấp đa dạng các thương hiệu giày nổi tiếng với mức giá cạnh tranh. Đến với FootForward, bạn sẽ tìm thấy những đôi giày phù hợp nhất cho mọi hoạt động từ thể thao, dạo phố đến những sự kiện quan trọng.</p>
                        <p>Hãy ghé thăm cửa hàng của chúng tôi để trải nghiệm và nhận được sự tư vấn tận tình từ đội ngũ nhân viên của chúng tôi.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1078.488962511698!2d105.74321324849164!3d21.038340987533502!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455d366faa727%3A0x7bc55bfa99993fdd!2zMSBQLiBUcuG7i25oIFbEg24gQsO0LCBYdcOibiBQaMawxqFuZywgTmFtIFThu6sgTGnDqm0sIEjDoCBO4buZaSAxMDAwMDAsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1722002515679!5m2!1svi!2s" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
