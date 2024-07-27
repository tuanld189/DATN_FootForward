<div class="shop-wrapper-tab-panel">
    <div class="shop-slider" style="border-right: 1px solid rgb(182, 181, 181); padding-right:10px;">
        <div class="shop-product-area" >
            <div class="row" >
                <!-- Sắp xếp -->
                <div class="col-md-12 mb-3" style="padding-top:10px;">
                    <div class="col-md-3 mr-4">
                        <form id="sortForm" method="GET" action="{{ route('shop') }}">
                            <select name="sort" id="sort" class="form-control" onchange="submitSortForm()">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất
                                </option>
                                <option value="price_high_low"
                                    {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Giá cao đến thấp
                                </option>
                                <option value="price_low_high"
                                    {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Giá thấp đến cao
                                </option>
                                <option value="best_selling" {{ request('sort') == 'best_selling' ? 'selected' : '' }}>
                                    Bán chạy</option>
                            </select>
                        </form>
                    </div>
                </div>

                @forelse ($products as $product)
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
                @empty
                    <div class="col-12">
                        <p>Không tìm thấy sản phẩm.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<script>
    function submitSortForm() {
        $('#sortForm').submit();
    }

    $(document).ready(function() {
        $('#sortForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                beforeSend: function() {
                    // Optional loading animation
                },
success: function(data) {
                    $('#product_list').html($(data).find('#product_list').html());
                    // Update pagination if necessary
                    $('#pagination').html($(data).find('#pagination').html());
                },
                error: function() {
                    alert('Không thể tải sản phẩm.');
                }
            });
        });

        // Trigger sorting in shop when sorting changes in product-list
        $('#sort').on('change', function() {
            $('#sortForm').submit();
        });
    });
</script>
