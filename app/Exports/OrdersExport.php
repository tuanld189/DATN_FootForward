<?php

// namespace App\Exports;

// use App\Models\Order;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class OrdersExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Order::all();
//     }
// }


namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class OrdersExport implements FromCollection, WithHeadings
{
    /**
     * Retrieve the collection of orders with their related information.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('orders')
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select(
                'orders.id',
                'orders.user_id',
                'orders.user_name',
                'orders.user_email',
                'orders.user_phone',
                'orders.user_address',
                'orders.user_note',
                'orders.is_ship_user_same_user',
                'orders.ship_user_name',
                'orders.ship_user_email',
                'orders.ship_user_phone',
                'orders.ship_user_address',
                'orders.ship_user_note',
                'orders.status_order',
                'orders.status_payment',
                'orders.total_price',
                'orders.created_at',
                'orders.updated_at'
            )
            ->distinct()
            ->get();
    }

    /**
     * Define the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'User Name',
            'User Email',
            'User Phone',
            'User Address',
            'User Note',
            'Is Ship User Same User',
            'Ship User Name',
            'Ship User Email',
            'Ship User Phone',
            'Ship User Address',
            'Ship User Note',
            'Status Order',
            'Status Payment',
            'Total Price',
            'Created At',
            'Updated At',
        ];
    }
}
