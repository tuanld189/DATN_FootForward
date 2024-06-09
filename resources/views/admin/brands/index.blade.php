@extends('admin.layout.master')
@section('title')
    List Brand's Product
@endsection
@section('content')
    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>IMAGE</th>
            <th>Is Active</th>
            <th>CREATE_AT</th>
            <th>UPDATE_AT</th>
            <th>ACTION</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>
                    <img src="{{ Storage::url($item->image)}}" alt="" width="100px">
                </td>
                <td>{!!$item->is_active ? '<span class="badge bg-success">Yes</span>'
                :'<span class="badge bg-danger">No</span>' !!}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                <td>
                    <a href="{{ route('admin.brands.show',$item->id) }}" class="btn btn-info mb-2">Chi tiết</a>
                    <a href="{{ route('admin.brands.edit',$item->id) }}" class="btn btn-warning mb-2">Sửa</a>
                    <a href="{{ route('admin.brands.destroy',$item->id) }}" class="btn btn-danger mb-2"
                        onclick="return confirm('Chắc chắn chưa')"
                        >Xóa</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$data->links()}}


@endsection
