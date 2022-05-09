<?php

namespace App\Http\Controllers\Profile\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\Orders\DownloadMedicalCertificateRequest;
use App\Repositories\Profile\OrdersRepository;
use Illuminate\Support\Str;
use function auth;
use function view;

class OrdersController extends Controller
{
    /**
     * @param OrdersRepository $ordersRepository
     */
    public function __construct(
        private OrdersRepository $ordersRepository
    ) {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patient    = Auth()->user();
        $orders     = $this->ordersRepository->getOrdersToIndexByPatient($patient);

        return view('layouts.profile.orders.index', compact('orders'));
    }

    /**
     * @param int $orderId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(int $orderId): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $order = $this->ordersRepository->getOrderToShow($orderId);
        } catch (\Exception $e) {

            \Log::info('App.Http.Controllers.Profile.Orders.OrdersController.show', [
                'message' => 'Order not found',
                'data' => [
                    'order_id' => $orderId,
                ],
            ]);

            $notifyMessage = __("pages.profile.orders.show.not_found");
            toastr()->error($notifyMessage);

            return redirect()->back();
        }

        return view('layouts.profile.orders.show', compact('order'));
    }

    /**
     * @param DownloadMedicalCertificateRequest $request
     * @param int $orderId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadMedicalCertificate(DownloadMedicalCertificateRequest $request, int $orderId): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $order = $this->ordersRepository->getOrderToDownload($orderId);

        $certificatePathRelative = $order->orderResult?->certificate_path;
        $certificatePathFull = \Storage::disk('public')->path($certificatePathRelative);

        $certificateExtension = \File::extension($certificatePathFull);
        $serviceName = Str::slug($order->service->name)  . '.' . $certificateExtension;

        return response()->download($certificatePathFull, $serviceName);
    }
}
