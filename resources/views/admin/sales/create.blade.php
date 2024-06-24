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
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
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
                        <input class="form-check-input" type="checkbox" role="switch" name="status" id="status" checked>
                        <label class="form-check-label" for="status">Status</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Create Sale</button>
            </form>
        </div>
    </div>
@endsection

@section('script-libs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#product_id').select2({
        placeholder: 'Select products'
    });
});
</script>
@endsection
