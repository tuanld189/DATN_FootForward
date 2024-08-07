@extends('admin.layout.master')
@section('title')
    Product Detail
@endsection
@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Product Detail</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Product Detail</h5>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary mb-2">Back to List</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $model->id }}</td>
                        </tr>
                        <tr>
                            <th>Thumbnail</th>
                            <td>
                                {{-- @php
                                    $url = $model->img_thumbnail;
                                    if(!Str::contains($url, 'http')){
                                        $url = Storage::url($url);
                                    }
                                @endphp
                                <img src="{{ $url }}" alt="Product Image" width="100px"> --}}
                                <img src="{{ $item->img_thumbnail }}" alt="" width="100px">
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $model->name }}</td>
                        </tr>
                        <tr>
                            <th>SKU</th>
                            <td>{{ $model->sku }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $model->slug }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $model->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td>{{ $model->brand->name }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ number_format($model->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Content</th>
                            <td>{{ $model->content }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $model->description }}</td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td>
                                @foreach ($model->tags as $tag)
                                    <span class="badge bg-info">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Active</th>
                            <td>{!! $model->is_active ? '<span class="badge bg-warning">ON</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                        </tr>
                        <tr>
                            <th>Hot Deal</th>
                            <td>{!! $model->is_hot_deal ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                        </tr>
                        <tr>
                            <th>New</th>
                            <td>{!! $model->is_new ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                        </tr>
                        <tr>
                            <th>Show Home</th>
                            <td>{!! $model->is_show_home ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $model->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $model->updated_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection
