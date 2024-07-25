@extends('admin.layout.master')
@section('title')
    Add New Product
@endsection
@section('style-libs')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
<style>


    /* Style form inputs */
    .form-control {
        border: 1px solid #ced4da;
    }

    /* Style form labels */


    /* Style checkboxes */
    .form-check-input[type="checkbox"] {
        width: 1.25rem;
        height: 1.25rem;
    }

    /* Style table */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    /* Style variant table */
    .variant-table {
        margin-top: 20px;
    }

    .variant-table th, .variant-table td {
        padding: 10px;
        text-align: center;
    }

    .variant-table th {
        vertical-align: middle;
    }

    .variant-table td {
        vertical-align: middle;
    }

    .tags-select2 {
        width: 100%;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
{{-- INFO PRODUCT --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">INFORMATION</h4>

            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4">
                        <div class="col-md-5">
                            <div>
                                <label for="name" class="form-label">Product Name:</label>
                                <input type="text" class="form-control" id="name" name="name"placeholder="Enter name.................">
                            </div>

                            <div class="mt-3">
                                <label for="categories" class="form-label">Categories:</label>
                                <select name="category_id" id="category_id"  class="form-select">

                                    @foreach ($categories as $id => $value )
                                        <option value="{{$id}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3" >
                                <label for="brand_id" class="form-label">Brand: </label>
                                <select name="brand_id" id="brand_id"  class="form-select" aria-label="Default select example">

                                    @foreach ($brands as $id => $value )
                                        <option value="{{$id}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" mt-3">
                                <label for="sku" class="form-label">Sku:</label>
                                <input type="text" class="form-control" id="sku" placeholder="Enter sku................." value="{{strtoupper(Str::random(8))}}" name="sku">
                            </div>

                            <div class="mt-3">
                                <label for="img_thumbnail" class="form-label">Image Thumbnail:</label>
                                <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
                            </div>
                            <div class="mt-3">
                                <label for="price" class="form-label">Price:</label>
                                <input type="text" class="form-control" id="price" placeholder="Enter price................." name="price">
                            </div>
                        </div>

                        {{-- RIGHT --}}
                        <div class=" col-md-7">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check form-switch form-switch-primary">
                                        <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="is_active" checked>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch form-switch-warning">
                                        <input class="form-check-input" type="checkbox" role="switch" name="is_hot_deal" id="is_hot_deal" checked>
                                        <label class="form-check-label" for="is_hot_deal">Hot Deal</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" role="switch" name="is_new" id="is_new" checked>
                                        <label class="form-check-label" for="is_new">New</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch form-switch-danger">
                                        <input class="form-check-input" type="checkbox" role="switch" name="is_show_home" id="is_show_home" checked>
                                        <label class="form-check-label" for="is_show_home">Show Home</label>
                                    </div>
                                </div>
                            </div>
                            <div class="rpw">
                                <div class="mt-3">
                                    <label for="content" class="form-label">Short Content:</label>
                                    <textarea class="form-control" placeholder="Enter short content............................." id="content" name="content" rows="3"></textarea>
                                </div>
                                <div class="mt-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea class="form-control" placeholder="Enter description............................." id="ckeditor-classic" name="description" ></textarea>

                                </div>


                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
    <!--end col-->
</div>
{{-- VARIANT --}}



<div class="row" style="height:400px; overflow: scroll;">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">VARIANTS</h4>

            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th style="width: 50px; height: 50px;">Color</th>
                                    <th>Quantity</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sizes as $sizeID => $sizeName)
                                    @foreach ($colors as $colorID => $colorName)
                                        <tr>
                                            <td>{{ $sizeName }}</td>
                                            <td>
                                                <div style="width: 50px; height: 50px; background: {{ $colorName }}; border: 1px solid gray; text-align: center;"></div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="30" placeholder="Enter quantity............" name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]">
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" name="product_variants[{{ $sizeID . '-' . $colorID }}][image]">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
{{-- GALLERY --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                <button type="button" class="btn btn-primary" onclick="addImageGallery()">Add Photo</button>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4" id="gallery_list">
                        <div class="col-md-4" id="gallery_default_item">
                            <label for="gallery_default" class="form-label">Image:</label>
                            <div class="d-flex">
                                <input type="file" class="form-control" name="product_galleries[]"
                                       id="gallery_default">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


{{-- TAGS --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">TAGS</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div>
                                <label for="tags" class="form-label">Add Information:</label>
                                <select class="form-control tags-select2" id="tags" name="tags[]" multiple>
                                    <!-- Options will be dynamically loaded via AJAX -->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <button class="btn btn-success" type="submit">SAVE</button>

            </div><!-- end card header -->

        </div>
    </div>
    <!--end col-->
</div>

</form>
@endsection
@section('script-libs')
    {{-- <script src="//cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    
    <script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <!-- dropzone js -->
    <script src="assets/libs/dropzone/dropzone-min.js"></script>
    <!-- project-create init -->
    <script src="assets/js/pages/project-create.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
@endsection



@section('scripts')
    {{-- CKEDITOR.replace('description'); --}}
    <script>
        CKEDITOR.replace('ckeditor-classic');
    </script>

    <script>
     $(document).ready(function() {
        $('.tags-select2').select2({
            placeholder: '',
            tags: true,
            tokenSeparators: [',', ' '],
            ajax: {
                url: '/api/tags', // Đường dẫn đến endpoint lấy dữ liệu tags
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });

    function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection

