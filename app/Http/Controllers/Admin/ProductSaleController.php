<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSale;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class ProductSaleController extends Controller
{
    public function index()
    {
        $sales = ProductSale::all();
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'sale_price' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|boolean',
        ], [
            'end_date.after' => 'End Date must be a date after Start Date.',
        ]);

        ProductSale::create([
            'product_id' => $request->product_id,
            'sale_price' => $request->sale_price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.sales.index');
    }

    public function show(ProductSale $sale)
    {
        return view('admin.sales.show', compact('sale'));
    }
    public function edit(ProductSale $sale)
    {
        $products = Product::all();
        return view('admin.sales.edit', compact('sale', 'products'));
    }

    public function update(Request $request, ProductSale $sale)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'sale_price' => 'required|numeric',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after:start_date',
        'status' => 'nullable|boolean',
    ]);

    $sale->update([
        'product_id' => $request->product_id,
        'sale_price' => $request->sale_price,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => $request->has('status') ? true : false,
    ]);

    return redirect()->route('admin.sales.index');
}
    public function destroy(ProductSale $sale)
    {
        $sale->delete();
        return redirect()->route('admin.sales.index');
    }
}
