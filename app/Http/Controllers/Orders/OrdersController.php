<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\NextStepOrderRequest;
use App\Repositories\Orders\OrdersRepository;
use Illuminate\Http\Request;

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

    /**
     * @param Request $request
     * @param int $orderId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Routing\Route|object|string|null
     */
    public function show(Request $request, int $orderId)
    {
        try {
            $order = $this->ordersRepository->getOrderByIdToShow($orderId);
        } catch (\Exception $e) {

            \Log::info('App.Http.Controllers.Orders.OrdersController.show', [
                'message' => 'Order not found.',
                'data' => [
                    'order_id' => $orderId,
                    'exception_message' => $e->getMessage(),
                ],
            ]);

            $errorMessage = __('pages.orders.show.error');
            toastr()->error($errorMessage);

            return $request->route('orders.index');
        }

        $nextSteps = $this->ordersManager->getNextSteps($order);

        return view('layouts.orders.common.show', compact('order', 'nextSteps'));
    }

    /**
     * @param NextStepOrderRequest $request
     * @param int $orderId
     * @return mixed|void
     * @throws \Throwable
     */
    public function nextStep(NextStepOrderRequest $request, int $orderId)
    {
        $notifyMessageStatus = 'success';

        try {
            $order = $this->ordersRepository->getOrderByIdToNextStep($orderId);
        } catch (\Exception $e) {

            \Log::info('App.Http.Controllers.Orders.OrdersController.nextStep', [
                'message' => 'Order not found.',
                'data' => [
                    'order_id' => $orderId,
                    'exception_message' => $e->getMessage(),
                ],
            ]);

            $errorMessage = __('pages.orders.show.error');
            toastr()->error($errorMessage);

            return $request->route('orders.index');
        }

        try {
            $currentDoctor = \Auth::user();

            $this->ordersManager->handleNextStatus($request, $order, $currentDoctor);
        } catch (\Exception $e) {
            $notifyMessageStatus = 'error';

            \Log::info('App.Http.Controllers.Orders.OrdersController.nextStep', [
                'message' => 'Order not found.',
                'data' => [
                    'order_id' => $orderId,
                    'doctor_id' => $currentDoctor,
                    'exception_message' => $e->getMessage(),
                ],
            ]);
        }

        $step = $request->step;

        $notifyMessage = __("pages.orders.nextStep.statuses.$step.$notifyMessageStatus");
        toastr()->$notifyMessageStatus($notifyMessage);

        return redirect()->back();
    }
}