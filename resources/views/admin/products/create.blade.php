@extends('admin.layout.master')
@section('title')
    Add New Product
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
                                <input type="number" class="form-control" id="price" placeholder="Enter price................." name="price">
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
                                    <textarea class="form-control" placeholder="Enter description............................." id="description" name="description" ></textarea>

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
                        <table >

                            <tr >
                                <th>Size</th>
                                <th style="width: 50px; height:50px;" class="mr-3">Color</th>
                                <th>Quantity</th>
                                <th>Image</th>
                            </tr>

                            @foreach ($sizes as $sizeID => $sizeName)
                                @foreach ($colors as $colorID => $colorName)
                                <tr >
                                    <td>{{$sizeName}}</td>
                                    <td>
                                        <div style="width: 50px; height:50px; background:{{$colorName}}; border:1px solid gray;  text-align: center;"></div>

                                    </td>
                                    <td >
                                        <input type="text" class="form-control" value="30" placeholder="Enter quantity............" name="product_variants[{{ $sizeID. '-'. $colorID}}][quantity]">

                                    </td>
                                    <td>
                                        <input type="file"  class="form-control" name="product_variants[{{ $sizeID. '-'. $colorID}}][image]">
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </table>



                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end col-->
</div>
{{-- GALLERY --}}
<div class="row" >
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">GALLERIES</h4>

            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <div>
                                <label for="gallery_1" class="form-label">Gallery 1:</label>
                                <input type="file" class="form-control" name="product_galleries[]" id="gallery_1">

                            </div>


                        </div>

                        <div class="col-md-4">
                            <div>
                                <label for="gallery_2" class="form-label">Gallery 2:</label>
                                <input type="file" class="form-control" name="product_galleries[]" id="gallery_2">

                            </div>


                        </div>
                        <div class="col-md-4">
                            <div>
                                <label for="gallery_3" class="form-label">Gallery 3:</label>
                                <input type="file" class="form-control" name="product_galleries[]" id="gallery_3">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end col-->
</div>
{{-- TAGS --}}
<div class="row" >
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
                                <label for="tags" class="form-label">Tags:</label>
                                <select type="password" class="form-control" id="tags" name="tags[]" multiple>
                                    @foreach ($tags as $id => $name )
                                    <option value="{{$id}}">{{$name}}</option>
                                     @endforeach
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


{{--
BUTTOn --}}
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
    <script src="//cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection

@section('scripts')
<script>
    CKEDITOR.replace('description')
</script>
@endsection

