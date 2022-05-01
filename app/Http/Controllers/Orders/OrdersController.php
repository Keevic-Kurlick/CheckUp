<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Repositories\Orders\OrdersRepository;

class OrdersController extends Controller
{
    /**
     * @param OrdersManager $ordersManager
     * @param OrdersRepository $ordersRepository
     */
    public function __construct(
        private OrdersManager $ordersManager,
        private OrdersRepository $ordersRepository
    ) {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $orders = $this->ordersRepository->getOrdersToIndex();

        return view('layouts.orders.common.index', compact('orders'));
    }
}