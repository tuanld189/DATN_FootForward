<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSale;
use Illuminate\Http\Request;

class ProductSaleController extends Controller
{
    protected function isValidDate($date)
    {
        return strtotime($date) !== false;
    }
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $sales = $product->sales;
        return view('admin.sales.index', compact('product', 'sales'));
    }

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('admin.sales.create', compact('product'));
    }

    public function store(Request $request, $productId)
{
    $request->validate([
        'sale_price' => 'required|numeric',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after:start_date',
        'status' => 'boolean'
    ]);

   
    $product = Product::findOrFail($productId);
    $product->sales()->create($request->all());

    return redirect()->route('admin.products.sales.index', $productId)
                     ->with('success', 'Sale price added successfully.');
    }

    public function show($id)
    {
        $model = ProductSale::findOrFail($id);
        return view('admin.sales.show', compact('model'));
    }
    public function edit($productId, $id)
{
    $sale = ProductSale::findOrFail($id);
    return view('admin.products.sales.edit', compact('sale', 'productId')); // Sửa đổi tên view ở đây
}

    public function update(Request $request, $productId, $id)
    {
        $request->validate([
            'sale_price' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'boolean'
        ]);

        $sale = ProductSale::findOrFail($id);
        $sale->update($request->all());

        return redirect()->route('admin.products.sales.index', $productId)
                         ->with('success', 'Sale price updated successfully.');
    }

    public function destroy($productId, $id)
    {
        $sale = ProductSale::findOrFail($id);
        $sale->delete();

        return redirect()->route('admin.products.sales.index', $productId)
                         ->with('success', 'Sale price deleted successfully.');
    }
}
