<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSale;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

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
        'product_id' => 'required|array',
        'product_id.*' => 'exists:products,id',
        'sale_price' => 'required|numeric|min:0',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'status' => 'boolean',
    ]);

    $status = $request->filled('status') ? true : false;

    $sale = ProductSale::create([
        'sale_price' => $request->sale_price,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => $status,
    ]);

    $sale->products()->attach($request->product_id);

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
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'sale_price' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'boolean',
        ]);

        $status = $request->filled('status') ? true : false;

        $sale->update([
            'sale_price' => $request->sale_price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $status,
        ]);

        // Sync the product association
        $sale->products()->sync($request->product_id);

        return redirect()->route('admin.sales.index');
    }

    public function destroy(ProductSale $sale)
    {
        $sale->delete();
        return redirect()->route('admin.sales.index');
    }
}
