<?php

namespace App\Http\Controllers\Orders;

use App\Http\Requests\Orders\CancelOrderRequest;
use App\Http\Requests\Orders\NextStepOrderRequest;
use App\Models\Order;
use App\Models\OrderResult;
use App\Models\User;
use App\Repositories\Orders\OrderResultsRepository;
use App\Services\Orders\OrderService;
use Illuminate\Support\Facades\DB;

class OrdersManager
{

    /**
     * @param OrderResultsRepository $orderResultsRepository
     */
    public function __construct(
        private OrderResultsRepository $orderResultsRepository
    ) {}

    /**
     * @param Order $order
     * @return array|string[]
     */
    public function getNextSteps(Order $order): array
    {
        $nextSteps      = [];
        $isStepsExists  = array_key_exists($order->status, OrderService::STEPS);

        if (!empty($isStepsExists)) {
            $nextSteps = OrderService::STEPS[$order->status];
        }

        if (in_array(Order::COMPLETE_STATUS, $nextSteps) && empty($order->certificate_path)) {

            $nextSteps = array_filter($nextSteps, function ($step) {
                return $step !== Order::COMPLETE_STATUS;
            });

            array_unshift($nextSteps, Order::ADDITIONAL_STEP_MAKE_MEDICAL_CERTIFICATE);
        }

        return $nextSteps;
    }

    /**
     * @param NextStepOrderRequest $request
     * @param Order $order
     * @param User $doctor
     * @return void
     * @throws \Throwable
     */
    public function handleNextStatus(NextStepOrderRequest $request, Order $order, User $doctor)
    {
        $nextStatus = $request->step;

        switch ($nextStatus)
        {
            case Order::IN_PROGRESS_STATUS: {
                $this->inProgressHandle($order, $nextStatus, $doctor);

                break;
            }
        }
    }

    /**
     * @param CancelOrderRequest $request
     * @param Order $order
     * @return Order
     * @throws \Throwable
     */
    public function cancelOrder(CancelOrderRequest $request, Order $order): Order
    {
        $cancelMessage  = $request->cancel_message;
        $orderResult    = $this->orderResultsRepository->getOrderResultByOrderIdToUpdate($order->id);

        if (empty($orderResult)) {
            $orderResult = $this->makeOrderResultByOrderId($order->id);
        }

        DB::beginTransaction();

        $order->update([
            'status' => Order::CANCEL_STATUS,
        ]);

        $orderResult->update([
            'cancel_message' => $cancelMessage,
        ]);

        DB::commit();

        return $order;
    }

    /**
     * @param int $orderId
     * @return OrderResult
     */
    private function makeOrderResultByOrderId(int $orderId): OrderResult
    {
        $orderResults = new OrderResult();
        $orderResults->Order_id = $orderId;
        $orderResults->save();

        return $orderResults;
    }

    /**
     * @param Order $order
     * @param string $nextStatus
     * @param User $doctor
     * @return void
     * @throws \Throwable
     */
    private function inProgressHandle(Order $order, string $nextStatus, User $doctor)
    {
        DB::beginTransaction();
        $order->update([
            'status'    => $nextStatus,
            'doctor_id' => $doctor->id,
        ]);
        DB::commit();
    }
}