<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\Vourcher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VourcherController extends Controller
{
    const PATH_VIEW = 'admin.vourchers.';
    const PATH_UPLOAD = 'vourchers';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vourchers = Vourcher::query()->latest('id')->paginate(5);

        return view(self::PATH_VIEW . 'index', compact('vourchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . 'create');
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'nullable|max:255|unique:vourchers,code,',
            'description' => 'required',
            'discount_type' => 'required|in:percentage,amount',
            'discount_value' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->discount_type === 'percentage' && ($value < 0 || $value > 100)) {
                        $fail('The discount value must be between 0 and 100 for percentage discounts.');
                    }
                },

            ],
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'quantity' => 'required|integer|min:0',
        ]);

        // Kiểm tra nếu end_date đã qua, đặt is_active thành false
        if (Carbon::now()->isAfter($request->end_date)) {
            $request->merge(['is_active' => false]);
        }

        Vourcher::create($request->all());

        return redirect()->route('admin.vourchers.index')
            ->with('success', 'Vourcher created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Vourcher::findOrFail($id);
        return view(self::PATH_VIEW . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Vourcher::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string  $id)
    {
        $model = Vourcher::findOrFail($id);
        $request->validate([
            'code' => 'nullable|max:255|unique:vourchers,code,' . $model->id,
            'description' => 'required',
            'discount_type' => 'required|in:percentage,amount',
            'discount_value' => [
                'required',
'numeric',
function ($attribute, $value, $fail) use ($request) {
                    if ($request->discount_type === 'percentage' && ($value < 0 || $value > 100)) {
                        $fail('The discount value must be between 0 and 100 for percentage discounts.');
                    }
                },

            ],
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'quantity' => 'required|integer|min:0',
        ]);

        // Kiểm tra nếu end_date đã qua, thì tự đặt is_active thành false
        if (Carbon::now()->isAfter($request->end_date)) {
            $request->merge(['is_active' => false]);
        }

        $model->update($request->all());

        return redirect()->route('admin.vourchers.index')
            ->with('success', 'Vourcher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    // }

    public function destroy(string $id)
    {
        $vourcher = Vourcher::find($id);
        $vourcher->delete();
        return back();
    }

    public function redeemVoucher($id)
    {
        $voucher = Vourcher::findOrFail($id);

        // Kiểm tra xem mã voucher có thể sử dụng không
        if (!$voucher->canBeRedeemed()) {
            return response()->json(['message' => 'Mã voucher không khả dụng để sử dụng.'], 400);
        }

        // Thực hiện hành động sử dụng mã voucher (ví dụ: áp dụng giảm giá cho đơn hàng)

        // Sau khi sử dụng thành công, giảm số lượng voucher
        $voucher->redeem();

        return response()->json(['message' => 'Sử dụng mã voucher thành công.'], 200);
    }
}
