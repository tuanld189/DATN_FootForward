@extends('admin.layout.master')
@section('title')
    Edit Product
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
                                <div>
                                    <label for="name" class="form-label">Product Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" placeholder="Enter name...">
                                </div>

                                <div class="mt-3">
                                    <label for="category_id" class="form-label">Categories:</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        @foreach ($categories as $id => $value)
                                            <option value="{{ $id }}" {{ $product->category_id == $id ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <label for="brand_id" class="form-label">Brand:</label>
                                    <select name="brand_id" id="brand_id" class="form-select">
                                        @foreach ($brands as $id => $value)
                                            <option value="{{ $id }}" {{ $product->brand_id == $id ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <label for="sku" class="form-label">Sku:</label>
                                    <input type="text" class="form-control" id="sku" name="sku" value="{{ $product->sku }}" placeholder="Enter sku...">
                                </div>

                                <div class="mt-3">
                                    <label for="img_thumbnail" class="form-label">Image Thumbnail:</label>
                                    <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
                                    <img src="{{ Storage::url($product->img_thumbnail) }}" alt="Thumbnail" width="100px" class="mt-2">
                                </div>

                                <div class="mt-3">
                                    <label for="price" class="form-label">Price:</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" placeholder="Enter price...">
                                </div>
                            </div>

                            {{-- RIGHT --}}
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-switch-primary">
                                            <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="is_active" {{ $product->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-switch-warning">
                                            <input class="form-check-input" type="checkbox" role="switch" name="is_hot_deal" id="is_hot_deal" {{ $product->is_hot_deal ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_hot_deal">Hot Deal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" type="checkbox" role="switch" name="is_new" id="is_new" {{ $product->is_new ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_new">New</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-switch-danger">
                                            <input class="form-check-input" type="checkbox" role="switch" name="is_show_home" id="is_show_home" {{ $product->is_show_home ? 'checked' : '' }}>
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
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="height: 400px; overflow: scroll;">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">VARIANTS</h4>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4">
                        <table>
                            <tr>
                                <th>Size</th>
                                <th style="width: 50px; height:50px;" class="mr-3">Color</th>
                                <th>Quantity</th>
                                <th>Image</th>
                            </tr>
                            @foreach($product->variants as $variant)
                            <div class="col-md-6 mb-3">
                                <label for="variant_{{ $variant->id }}" class="form-label">{{ $variant->size->name }} - {{ $variant->color->name }}</label>
                                <input type="number" class="form-control" id="variant_{{ $variant->id }}" name="product_variants[{{ $variant->size->id }}-{{ $variant->color->id }}][quantity]" value="{{ $variant->quantity }}" required>
                                <input type="file" class="form-control mt-2" id="variant_image_{{ $variant->id }}" name="product_variants[{{ $variant->size->id }}-{{ $variant->color->id }}][image]">
                                @if($variant->image)
                                    <img src="{{ Storage::url($variant->image) }}" alt="" width="100px" class="mt-2">
                                @endif
                            </div>
                        @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3" >
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">GALLERIES</h4>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4">

                        <label for="product_galleries" class="form-label">Product Galleries:</label>
                            <input type="file" class="form-control" id="product_galleries" name="product_galleries[]" multiple>
                            <div class="row mt-2">
                                @foreach($product->galleries as $gallery)
                                    <div class="col-md-2">
                                        <img src="{{ Storage::url($gallery->image) }}" alt="" width="100px">
                                    </div>
                                @endforeach
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-3" >
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">TAGS</h4>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4">


                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags:</label>
                            <select class="form-select" id="tags" name="tags[]" multiple>
                                @foreach($tags as $id => $name)
                                    <option value="{{ $id }}" {{ in_array($id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $name }}</option>
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
