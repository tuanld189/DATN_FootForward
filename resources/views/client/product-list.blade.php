<style>
    .select-container {
        position: relative;


    }

    .select-container select {
        width: 100%;
        padding-right: 30px;
        border-radius: 5px;
        /* Bo góc */
        transition: border-color 0.3s ease, box-shadow 0.3s ease;

    }

    .select-container select:focus {
        border-color: #8a8f6a;
        /* Màu viền khi focus */
        outline: none;
        /* Loại bỏ đường viền mặc định của trình duyệt */

    }

    .select-container i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        transition: transform 0.3s ease;
    }

    .select-container.select-focused i {
        transform: translateY(-50%) rotate(180deg);
    }

    .select option {
        text-align: left;
    }

    .active>.page-link,
    .page-link.active {
        background-color: #8a8f6a;
    }

    .pagination {
        justify-content: flex-end;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div class="shop-wrapper-tab-panel ">
    <div class="shop-slider">
        <div class="shop-product-area">
            <div class="row">
                <!-- Sắp xếp -->
                <div class="col-md-12 shadow-lg"
                    style="display: flex; justify-content: flex-end;height: 60px;padding: 10px;width: 840px;margin-left: 10px; background-color: #8a8f6a4a;">
                    <div class="col-md-3 ">
                        <form id="sortForm" method="GET" action="{{ route('shop') }}">
                            <div class="select-container">
                                <select name="sort" id="sort" class="form-control" onchange="submitSortForm()"
                                    style="border-color: white;border-radius: 10px;">
                                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Tất cả sản phẩm
                                    </option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất
                                    </option>
                                    <option value="price_high_low"
                                        {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Giá cao đến thấp
                                    </option>
                                    <option value="price_low_high"
                                        {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Giá thấp đến cao
                                    </option>
                                    <option value="best_selling"
                                        {{ request('sort') == 'best_selling' ? 'selected' : '' }}>Bán chạy</option>
                                </select>
                                <i id="sortIcon" class="fas fa-chevron-down"></i>
                            </div>
                        </form>
                    </div>

                </div>


                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-4 col-sm-6 mt-30">
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{ route('client.show', $product->id) }}">
                                    <img class="img-fluid" src="{{ Storage::url($product->img_thumbnail) }}"
                                        alt="">
                                </a>
                                <span class="label-product label-new">new</span>
                                @if ($product->sales->isNotEmpty() && $product->sales->first()->pivot && $product->sales->first()->status)
                                    @php
                                        $discountPercentage =
                                            (($product->price - $product->sales->first()->pivot->sale_price) /
                                                $product->price) *
                                            100;
                                    @endphp
                                    <span class="label-product label-sale">-{{ round($discountPercentage, 0) }}%</span>
                                @endif
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ route('client.show', $product->id) }}">{{ $product->name }}</a></h3>
                                <div class="price-box">
                                    @if ($product->sales->isNotEmpty() && $product->sales->first()->pivot && $product->sales->first()->status)
                                        <span class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                            VNĐ</span>
                                        <span
                                            class="new-price">{{ number_format($product->sales->first()->pivot->sale_price, 0, ',', '.') }}
                                            VNĐ</span>
                                    @else
                                        <span class="new-price">{{ number_format($product->price, 0, ',', '.') }}
                                            VNĐ</span>
                                    @endif
                                </div>
                                <div class="product-action">
                                    <button class="add-to-cart" title="Thêm vào giỏ hàng"><i class="fa fa-plus"></i>
                                        Thêm vào giỏ hàng</button>
                                    <div class="star_content">
                                        <ul class="d-flex">
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star-o" href="#"><i class="fa fa-star-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($products->isEmpty())
                    <div class="col-12">
                        <p>Không tìm thấy sản phẩm.</p>
                    </div>
                @endif

                <!-- Phân trang -->
                <div class="col-12 mt-4">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

