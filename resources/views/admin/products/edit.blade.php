@extends('admin.layout.master')
@section('title', 'Edit Product')

@section('style-libs')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>
        .gallery-container {
            display: flex;
            flex-wrap: wrap;
        }

        .gallery-item {
            position: relative;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .gallery-item img {
            max-width: 150px;
            height: auto;
            display: block;
        }

        .delete-gallery {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            padding: 3px 8px;
            border-radius: 50%;
            cursor: pointer;
        }
        .table-bordered td {
            vertical-align: middle !important; /* Canh giữa dọc */
            text-align: center !important; /* Canh giữa ngang */
        }

        .table-bordered td .color-indicator {
            width: 20px; /* Độ rộng của hình màu */
            height: 20px; /* Chiều cao của hình màu */
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 50%; /* Hình tròn */
        }

        .table-bordered td .color-name {
            display: inline-block;
            margin-left: 5px; /* Khoảng cách với hình màu */
        }
    </style>
@endsection

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Product: {{ $product->name }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">INFORMATION</h4>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">

        <div class="col-md-5">
            <div class="mt-3">
                <label for="name" class="form-label">Product Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}"
                    placeholder="Enter name...">
            </div>
            <div class="mt-3">
                <label for="category_id" class="form-label">Categories:</label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach ($categories as $id => $value)
                        <option value="{{ $id }}" {{ $product->category_id == $id ? 'selected' : '' }}>
                            {{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <label for="brand_id" class="form-label">Brand:</label>
                <select name="brand_id" id="brand_id" class="form-select">
                    @foreach ($brands as $id => $value)
                        <option value="{{ $id }}" {{ $product->brand_id == $id ? 'selected' : '' }}>
                            {{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <label for="sku" class="form-label">Sku:</label>
                <input type="text" class="form-control" id="sku" name="sku" value="{{ $product->sku }}"
                    placeholder="Enter sku...">
            </div>

            <div class="mt-3">
                <label for="img_thumbnail" class="form-label">Image Thumbnail:</label>
                <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
                <img src="{{ Storage::url($product->img_thumbnail) }}" alt="Thumbnail" width="100px" class="mt-2">
            </div>

            <div class="mt-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ number_format($product->price, 0, ',', '.') }}" >
            </div>
    </div>

        {{-- RIGHT --}}
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-check form-switch form-switch-primary">
                        <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="is_active"
                            {{ $product->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch form-switch-warning">
                        <input class="form-check-input" type="checkbox" role="switch" name="is_hot_deal"
                            id="is_hot_deal" {{ $product->is_hot_deal ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_hot_deal">Hot Deal</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch form-switch-success">
                        <input class="form-check-input" type="checkbox" role="switch" name="is_new" id="is_new"
                            {{ $product->is_new ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_new">New</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch form-switch-danger">
                        <input class="form-check-input" type="checkbox" role="switch" name="is_show_home"
                            id="is_show_home" {{ $product->is_show_home ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_show_home">Show Home</label>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <label for="content" class="form-label">Short Content:</label>
                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter short content...">{{ $product->content }}</textarea>
            </div>

            <div class="mt-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="7">{{ $product->description }}</textarea>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
</div>
</div>
        {{-- VARIANTS --}}
        <div class="row mt-3 " >
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">VARIANTS</h4>
                    </div>
                    <div class="card-body " style="height:400px; overflow: scroll;">
                        <div class="live-preview">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->variants as $variant)
                                            <tr>
                                                <td>{{ $variant->size->name }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="color-indicator" style="background-color: {{ $variant->color->name }}"></div>
                                                        <div class="color-name">{{ $variant->color->name }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control text-center" id="variant_{{ $variant->id }}"
                                                           name="product_variants[{{ $variant->size->id }}-{{ $variant->color->id }}][quantity]"
                                                           value="{{ $variant->quantity }}" required>
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control" id="variant_image_{{ $variant->id }}"
                                                        name="product_variants[{{ $variant->size->id }}-{{ $variant->color->id }}][image]" >
                                                    @if ($variant->image)
                                                        <img src="{{ Storage::url($variant->image) }}" alt="" width="100px" class="mt-2">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   {{-- GALLERIES --}}


        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">GALLERIES</h4>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="mb-3">
                                    <label for="product_galleries" class="form-label"> Add Product Galleries: {{ count($product->galleries) }}</label>
                                    <input type="file" class="form-control" id="product_galleries"
                                           name="product_galleries[]" multiple>
                                    <div class="gallery-container">
                                        @foreach ($product->galleries as $gallery)
                                            <div class="gallery-item" data-gallery-id="{{ $gallery->id }}">
                                                <img src="{{ Storage::url($gallery->image) }}" alt="Gallery Image">
                                                <button type="button" class="delete-gallery"
                                                        data-gallery-id="{{ $gallery->id }}" data-image-url="{{ Storage::url($gallery->image) }}">
                                                    X
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- TAGS --}}

 <div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">TAGS</h4>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4">
                        <div class="mb-3">
                            <label for="tags" class="form-label">Add Information:</label>
                            <select class="form-select tags-select2" id="tags" name="tags[]" multiple>
                                @foreach ($product->tags as $tag)
                                    <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="row">
            <div class="col-lg-12">

                <button type="submit" class="btn btn-success">Update Product</button>
            </div>
        </div>
    </form>
    </div>
    </div>
    </div>
    </div>
@endsection
@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tags-select2').select2({
                placeholder: 'Select tags',
                ajax: {
                    url: '{{ route("tags.search") }}', // Đường dẫn tới phương thức tìm kiếm tags
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        $(document).ready(function() {
            // Delete gallery item
            $('.delete-gallery').click(function() {
                if (confirm("Are you sure you want to delete this gallery?")) {
                    var galleryId = $(this).data('gallery-id');
                    var imageUrl = $(this).data('image-url');

                    // Ajax request to delete gallery
                    $.ajax({
                        url: '{{ route('admin.products.gallery.delete') }}',
                        method: 'DELETE',
                        data: {
                            gallery_id: galleryId,
                            image_url: imageUrl,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Remove the gallery item from UI
                            if (response.success) {
                                $(`.gallery-item[data-gallery-id=${galleryId}]`).remove();
                                $('#gallery-count').text($('.gallery-item').length + ' galleries');
                            } else {
                                alert('Failed to delete gallery. Please try again.');
                            }
                        },
                        error: function() {
                            alert('Failed to delete gallery. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
