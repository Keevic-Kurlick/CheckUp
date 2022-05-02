<?php

namespace App\Http\Controllers\Orders;

use App\Http\Requests\Orders\NextStepOrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Services\Orders\OrderService;
use Illuminate\Support\Facades\DB;

class OrdersManager
{
    /**
     * @param Order $order
     * @return array|string[]
     */
    public function getNextSteps(Order $order): array
    {
        $nextSteps = OrderService::STEPS[$order->status];

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