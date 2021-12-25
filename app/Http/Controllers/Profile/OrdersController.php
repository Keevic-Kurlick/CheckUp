<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrdersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ordersList(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patient    = Auth()->user();
        $orders     = $this->getOrdersToShowByPatient($patient);

        return view('layouts.profile.orders', compact('orders'));
    }

    /**
     * @param $patient
     * @return array
     */
    private function getOrdersToShowByPatient($patient): array
    {
        $orders     = Order::selectRaw('orders.*,
                                        services.name as service_name,
                                        services.price as service_price')
            ->wherePatientId($patient->id)
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->get()
            ->map(function ($order) {
                return [
                    'service_name'  => $order->service_name,
                    'service_price' => $order->service_price,
                    'created_at'    => $order->created_at->format('d.m.Y'),
                    'status'        => Order::STATUS_MAP[$order->status],
                ];
            })
            ->toArray();

        return $orders;
    }
}
