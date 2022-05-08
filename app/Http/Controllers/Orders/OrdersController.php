<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CancelOrderRequest;
use App\Http\Requests\Orders\CompleteOrderRequest;
use App\Http\Requests\Orders\DownloadAnalysysScanRequest;
use App\Http\Requests\Orders\DownloadPassportScanRequest;
use App\Http\Requests\Orders\NextStepOrderRequest;
use App\Models\Order;
use App\Repositories\Orders\OrdersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

            return redirect()->route('orders.index');
        }

        $nextSteps = $this->ordersManager->getNextSteps($order);
        $currentUser = \Auth::user();

        return view('layouts.orders.common.show', compact('order', 'nextSteps', 'currentUser'));
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

            return redirect()->route('orders.index');
        }

        try {
            $currentDoctor = \Auth::user();

            $this->ordersManager->handleNextStatus($request, $order, $currentDoctor);
        } catch (\Exception $e) {
            $notifyMessageStatus = 'error';

            \Log::info('App.Http.Controllers.Orders.OrdersController.nextStep', [
                'message' => 'Order processing error.',
                'data' => [
                    'order_id'          => $orderId,
                    'doctor_id'         => $currentDoctor,
                    'step'              => $request->step,
                    'exception_message' => $e->getMessage(),
                ],
            ]);
        }

        $step = $request->step;

        $notifyMessage = __("pages.orders.nextStep.statuses.$step.$notifyMessageStatus");
        toastr()->$notifyMessageStatus($notifyMessage);

        return redirect()->back();
    }

    /**
     * @param CancelOrderRequest $request
     * @param int $orderId
     * @return \Illuminate\Routing\Route|object|string|void|null
     * @throws \Throwable
     */
    public function cancel(CancelOrderRequest $request, int $orderId)
    {
        $notifyMessageStatus = 'success';

        try {
            $order = $this->ordersRepository->getOrderByIdToCancel($orderId);
            $this->ordersManager->cancelOrder($request, $order);
        } catch (\Exception $e) {

            \Log::info('App.Http.Controllers.Orders.OrdersController.cancel', [
                'message' => 'Order cancellation error.',
                'data' => [
                    'order_id' => $orderId,
                    'exception_message' => $e->getMessage(),
                ],
            ]);

            $notifyMessageStatus = 'error';
        }

        $notifyMessage = __("pages.orders." . Order::CANCEL_STATUS .".$notifyMessageStatus");
        toastr()->$notifyMessageStatus($notifyMessage);

        return redirect()->back();
    }

    /**
     * @param CompleteOrderRequest $request
     * @param int $orderId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function complete(CompleteOrderRequest $request, int $orderId): \Illuminate\Http\RedirectResponse
    {
        $notifyMessageStatus = 'success';

        try {
            $this->ordersManager->completeStatusHandler($request, $orderId);
        } catch (\Exception $e) {

            \Log::info('App.Http.Controllers.Orders.OrdersController.complete', [
                'message' => 'Error when switching order to "complete" status.',
                'data' => [
                    'order_id' => $orderId,
                    'exception_message' => $e->getMessage(),
                ],
            ]);

            $notifyMessageStatus = 'error';
        }

        $notifyMessage = __("pages.orders." . Order::COMPLETE_STATUS .".$notifyMessageStatus");
        toastr()->$notifyMessageStatus($notifyMessage);

        return redirect()->back();
    }

    /**
     * @param DownloadPassportScanRequest $request
     * @param int $orderId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadPassportScan(DownloadPassportScanRequest $request, int $orderId): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $passportPath = $this->ordersRepository->getPassportPathToDownload($orderId);

        $fullPathToPassportScan = Storage::disk('public')->path($passportPath);

        return response()->download($fullPathToPassportScan, 'passport_scan');
    }

    /**
     * @param DownloadAnalysysScanRequest $request
     * @param int $orderId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadAnalysisScan(DownloadAnalysysScanRequest $request, int $orderId): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $analysisScan = $this->ordersRepository->getAnalysisPathToDownload($orderId);

        $fullPathToAnalysisScan = Storage::disk('public')->path($analysisScan);

        return response()->download($fullPathToAnalysisScan, 'analysis_scan');
    }
}