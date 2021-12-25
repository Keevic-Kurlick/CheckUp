<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * @param CreateOrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateOrderRequest $request): \Illuminate\Http\RedirectResponse
    {
        $serviceId = $request->input('serviceId');

        /** @var Service $service */
        $service = Service::where('id', '=', $serviceId)->get()->first();
        $patient = Auth::user();

        Order::create($patient, $service);

        return redirect()->route('profile.orders.list');
    }
}
