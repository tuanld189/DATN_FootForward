@extends('admin.layout.master')

@section('style-libs')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-0">Database</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Sales</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Sale</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sales.update', $sale->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="product_id">Products</label>
                                    <select name="product_id[]" id="product_id" class="form-control select2" style="width: 100%;" multiple="multiple" required>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ $sale->products->contains($product->id) ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sale_price">Sale Price</label>
                                    <input type="text" name="sale_price" id="sale_price" class="form-control" value="{{ number_format($sale->sale_price, 0, ',', '.') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $sale->start_date }}">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $sale->end_date }}">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="status">Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="active" value="1" {{ $sale->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="inactive" value="0" {{ $sale->status == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inactive">
                                            Inactive
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Update Sale</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-libs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 with AJAX
            $('#product_id').select2({
                placeholder: 'Select products',
                ajax: {
                    url: '{{ route("admin.products.search-products") }}',
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

            // Add initial products to Select2
            var initialProducts = @json($sale->products->map(function($product) {
                return ['id' => $product->id, 'text' => $product->name];
            }));

            initialProducts.forEach(function(product) {
                if (!$('#product_id').find("option[value='" + product.id + "']").length) {
                    var option = new Option(product.text, product.id, true, true);
                    $('#product_id').append(option).trigger('change');
                }
            });
        });
    </script>
@endsection
