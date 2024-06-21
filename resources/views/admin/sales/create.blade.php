@extends('admin.layout.master')

@section('style-libs')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
    /* Custom CSS for checkbox */
    .form-check-label {
        display: flex;
        align-items: center;
    }

    .form-check-input[type="checkbox"] {
        margin-top: 0;
        margin-right: 8px; /* Adjust spacing between checkbox and label */
    }
</style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Sale</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.sales.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="product_id">Products</label>
                    <select name="product_id[]" id="product_id" class="form-control select2" style="width: 100%;" multiple="multiple" required>
                        <!-- Options will be loaded dynamically via AJAX -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="sale_price">Sale Price</label>
                    <input type="text" name="sale_price" id="sale_price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <div class="form-check form-switch form-switch-warning">
                        <input class="form-check-input" type="checkbox" role="switch" name="status" id="" checked>
                        <label class="form-check-label" for="status">Status</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Create Sale</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('script-libs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#product_id').select2({
        placeholder: 'Select products',
        ajax: {
            url: 'http://datn_footforward.test/admin/products/search-products',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(product) {
                        return {
                            id: product.id,
                            text: product.name
                        };
                    })
                };
            },
            cache: true
        }
    });

    // Xử lý khi form submit để lấy giá trị của Select2
    $('form').on('submit', function(event) {
        var selectedProducts = $('#product_id').val();
        $('#product_id').val(selectedProducts).trigger('change');
    });
});
</script>
@endsection
