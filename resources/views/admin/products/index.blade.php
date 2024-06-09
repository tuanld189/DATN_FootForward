@extends('admin.layout.master')
@section('title')
    List Product
@endsection
@section('content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
    <table class="table ">
        <tr>
            <th>ID</th>
            <th>CATEGORY_ID</th>
            <th>BRAND_ID</th>
            <th>NAME</th>
            <th>DESCRIPTION</th>
            <th>IMAGE</th>
            <th>PRICE</th>
            <th>QUANTITY</th>
            <th>CONTENT</th>
            <th>STATUS</th>
            <th>IS_HOT_DEAL</th>
            <th>IS_NEW</th>
            <th>IS_SHOW_HOME</th>
            <th>CREATE_AT</th>
            <th>UPDATE_AT</th>
            <th>ACTION</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->category->name}}</td>
                <td>{{$item->brand->name}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->description}}</td>

                <td>
                    <img src="{{ Storage::url($item->image)}}" alt="" width="100px">
                </td>
                <td>{{$item->price}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->content}}</td>
                <td>{!!$item->status? '<span class="badge bg-warning">ON</span>'
                :'<span class="badge bg-danger">No</span>' !!}</td>
                <td>{!!$item->is_hot_deal ? '<span class="badge bg-success">Yes</span>'
                :'<span class="badge bg-danger">No</span>' !!}</td>
                <td>{!!$item->is_new ? '<span class="badge bg-success">Yes</span>'
                :'<span class="badge bg-danger">No</span>' !!}</td>
                <td>{!!$item->is_show_home ? '<span class="badge bg-success">Yes</span>'
                :'<span class="badge bg-danger">No</span>' !!}</td>

                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                <td>
                    <a href="{{ route('admin.products.show',$item->id) }}" class="btn btn-info mb-2">Chi tiết</a>
                    <a href="{{ route('admin.products.edit',$item->id) }}" class="btn btn-warning mb-2">Sửa</a>
                    <a href="{{ route('admin.products.destroy',$item->id) }}" class="btn btn-danger mb-2"
                        onclick="return confirm('Chắc chắn chưa')"
                        >Xóa</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$data->links()}}
@endsection
