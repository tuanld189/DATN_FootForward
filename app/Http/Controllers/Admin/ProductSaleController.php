<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSale;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ProductSaleController extends Controller
{
    public function index()
    {
        $sales = ProductSale::all();
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
{
    $products = Product::whereDoesntHave('sales')->get();
    return view('admin.sales.create', compact('products'));
}

public function store(Request $request)
{
    $request->validate([
        'sale_price' => 'required|numeric|min:0',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'status' => 'boolean',
    ]);

    $status = $request->has('status');

    $sale = ProductSale::create([
        'sale_price' => $request->sale_price,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => $status,
    ]);

    // Attach products
    if ($request->has('product_id')) {
        $sale->products()->attach($request->product_id, ['sale_price' => $request->sale_price]);
    }

    return redirect()->route('admin.sales.index')->with('success', 'Sale created successfully.');
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
    try {
        // Validate input data
        $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'sale_price' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|boolean',
        ]);

        // Update sale attributes
        $sale->sale_price = $request->sale_price;
        $sale->start_date = $request->start_date;
        $sale->end_date = $request->end_date;
        $sale->status = (bool) $request->status;

        // Save the updated sale
        $sale->save();

        // Sync products
        $sale->products()->sync($request->product_id);

        // Redirect with success message
        return redirect()->route('admin.sales.index');

    } catch (ValidationException $e) {
        return back()->withErrors($e->validator->errors())->withInput();

    } catch (ModelNotFoundException $e) {
        Log::error('ProductSale not found: ' . $e->getMessage());
        return redirect()->route('admin.sales.index');

    } catch (\Exception $e) {
        Log::error('Error updating sale: ' . $e->getMessage());
return redirect()->route('admin.sales.index');
    }
}
    public function destroy(ProductSale $sale)
    {
        $sale->delete();
        return redirect()->route('admin.sales.index');
    }


}
