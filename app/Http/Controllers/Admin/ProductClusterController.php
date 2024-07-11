<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCluster;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class ProductClusterController extends Controller
{
    public function index()
    {
        $clusters = ProductCluster::with('products')->get();
        return view('admin.product_clusters.index', compact('clusters'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.product_clusters.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'products' => 'array'
        ]);

        $cluster = ProductCluster::create($request->only('name'));

        if ($request->has('products')) {
            $cluster->products()->sync($request->products);
        }

        return redirect()->route('admin.product-clusters.index');
    }

    public function show($id)
{
    $productCluster = ProductCluster::findOrFail($id);
    $products = Product::all(); // Nếu cần hiển thị danh sách sản phẩm liên kết

    return view('admin.product_clusters.show', compact('productCluster', 'products'));
}


    public function edit($id)
    {
        $productCluster = ProductCluster::findOrFail($id);
        $products = Product::all();
        return view('admin.product_clusters.edit', compact('productCluster', 'products'));
    }
    
    public function update(Request $request, $id)
    {
        // Tìm productCluster theo id
        $productCluster = ProductCluster::findOrFail($id);
    
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'products' => 'array', // Đảm bảo 'products' là một mảng
            'products.*' => 'integer|exists:products,id', // Đảm bảo mỗi sản phẩm là một số nguyên và tồn tại trong bảng products
        ]);
    
        try {
            // Bắt đầu transaction
            DB::beginTransaction();
    
            // Cập nhật thông tin của ProductCluster
            $productCluster->update($request->only('name'));
    
            // Đồng bộ các sản phẩm với ProductCluster
            $productCluster->products()->sync($request->products);
    
            // Commit transaction
            DB::commit();
    
            // Chuyển hướng về trang danh sách ProductClusters
            return redirect()->route('admin.product-clusters.index')->with('success', 'Cập nhật Product Cluster thành công.');
        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi xảy ra
            DB::rollBack();
            \Log::error('Lỗi khi cập nhật Product Cluster: ' . $e->getMessage());
            return redirect()->back()->withErrors('Đã xảy ra lỗi khi cập nhật Product Cluster.');
        }
    }
    
    


    public function destroy($id)
{
    $productCluster = ProductCluster::findOrFail($id);
    $productCluster->delete();

    return redirect()->route('admin.product-clusters.index')->with('success', 'Product Cluster deleted successfully.');
}

    
}
