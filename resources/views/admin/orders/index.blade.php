@extends('admin.layout.master')
@section('title', 'Danh sách đơn hàng')

@section('content')
    <!-- Page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Datatables</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Table -->
    <div class="row">
        <div class="col-12">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Order</h5>
                <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Thêm mới</a>

            </div>
            <div class="mr10">

                {{-- @dd( \App\Models\Order::STATUS_ORDER); --}}
                {{-- @foreach (\App\Models\Order::STATUS_ORDER as $key => $val)
                    @php
                        ${$key} = request($key) ?: old($key);
                    @endphp
                    <select name="{{ $key }}" class="form-control setupSelect2 ml10" id="">
                        @foreach ($val as $index => $item)
                            <option {{ ${$key} == $index ? 'selected' : '' }} value="{{ $index }}">
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                @endforeach --}}
            </div>
            <div class="card-body">
                {{-- <div class="table-responsive"> --}}
                <table class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            <th>Mã</th>
                            <th>Ngày tạo</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Trạng thái thanh toán</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </td>
                                <td>
                                    <a href="#">{{ $order->id }}</a>
                                </td>
                                <td>
                                    {{ $order->created_at->format('d-m-Y H:i:s') }}
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col text-start">
                                            <div><strong>N:</strong> {{ $order->user_name }}</div>
                                            <div><strong>P:</strong> {{ $order->user_phone }}</div>
                                            <div><strong>A:</strong> {{ $order->user_address }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ number_format($order->total_price, 2) }}
                                </td>
                                <td>{{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}</td>
                                <td>
                                    {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                                </td>




                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="btn btn-info btn-sm">SHOW</a>
                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                        class="btn btn-warning btn-sm">EDIT</a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <!-- End Table -->
@endsection

@section('script-libs')
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script> --}}
@endsection
