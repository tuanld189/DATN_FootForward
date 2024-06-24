{{-- @extends('admin.layout.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Sale</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.sales.update', $sale->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="product_id">Products</label>
                    <select name="product_id[]" id="product_id" class="form-control select2" style="width: 100%;" multiple="multiple" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $sale->products->contains($product->id) ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sale_price">Sale Price</label>
                    <input type="text" name="sale_price" id="sale_price" class="form-control" value="{{ $sale->sale_price }}" required>
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
                    <div class="form-check form-switch form-switch-warning">
                        <input class="form-check-input" type="checkbox" role="switch" name="status" {{ $sale->status ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Status</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update Sale</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('script-libs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#product_id').select2({
            placeholder: 'Select products',
            ajax: {
                url: '{{ route('admin.products.search') }}',
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
    });
</script>
@endsection --}}
