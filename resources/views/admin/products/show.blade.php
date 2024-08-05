@extends('admin.layout.master')
@section('title')
    Product Detail
@endsection
@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Chi tiết sản phẩm</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Chi tiết</li>
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
                    <h5 class="card-title mb-0">Chi tiết sản phẩm</h5>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary mb-2">Trở lại danh sách</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $model->id }}</td>
                        </tr>
                        <tr>
                            <th>Ảnh</th>
                            <td>
                                @php
                                    $url = $model->img_thumbnail;
                                    if(!Str::contains($url, 'http')){
                                        $url = Storage::url($url);
                                    }
                                @endphp
                                <img src="{{ $url }}" alt="Product Image" width="100px">
                            </td>
                        </tr>
                        <tr>
                            <th>Tên</th>
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
                            <th>Danh mục</th>
                            <td>{{ $model->category->name }}</td>
                        </tr>
                        <tr>
                            <th>hãng</th>
                            <td>{{ $model->brand->name }}</td>
                        </tr>
                        <tr>
                            <th>Giá</th>
                            <td>{{ number_format($model->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Nội dung</th>
                            <td>{{ $model->content }}</td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{{ $model->description }}</td>
                        </tr>
                        <tr>
                            <th>Nhãn</th>
                            <td>
                                @foreach ($model->tags as $tag)
                                    <span class="badge bg-info">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>{!! $model->is_active ? '<span class="badge bg-warning">ON</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                        </tr>
                        <tr>
                            <th>Sản phẩm hot</th>
                            <td>{!! $model->is_hot_deal ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                        </tr>
                        <tr>
                            <th>Sản phẩm mới</th>
                            <td>{!! $model->is_new ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                        </tr>
                        <tr>
                            <th>Hiển thị</th>
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
