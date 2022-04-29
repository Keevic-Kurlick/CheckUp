<?php

namespace App\Http\Controllers\Menu\OrderServices;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;

class OrderServicesController extends Controller
{
    /**
     * @param OrderServicesManager $orderServicesManager
     */
    public function __construct(
        private OrderServicesManager $orderServicesManager
    ) {}

    /**
     * @param CreateOrderRequest $request
     * @param int $serviceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateOrderRequest $request, int $serviceId): \Illuminate\Http\RedirectResponse
    {
        $response = redirect()->route('profile.orders.list');

        $notifyMessageStatus = 'success';

        try {
            $this->orderServicesManager->makeOrderByService($request, $serviceId);
        } catch (\Exception $e) {
            $notifyMessageStatus = 'error';

            $response = redirect()->back();
        }

        $notifyMessage = __("pages.order_services.store.{$notifyMessageStatus}");
        toastr()->$notifyMessageStatus($notifyMessage);

        return $response;
    }
}