<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Services\StoreServiceRequest;
use App\Http\Requests\Admin\Services\UpdateServiceRequest;
use App\Repositories\Admin\ServiceRepository;
use Illuminate\Support\Facades\Log;

class ServicesController extends Controller
{
    public function __construct(
        private ServiceRepository $serviceRepository,
        private ServicesManager $servicesManager
    ){}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $services = $this->serviceRepository->getServicesToIndex();

        return view('admin.services.index', compact('services'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * @param StoreServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(StoreServiceRequest $request)
    {
        $notifyMessageStatus = 'success';

        try {
            $this->servicesManager->storeService($request);
        } catch (\Exception $e) {
            $notifyMessageStatus = 'error';

            Log::error('App.Http.Controllers.Admin.Services.ServicesController.store',
                [
                    'data' => [
                        'message' => $e->getMessage(),
                    ],
                ]
            );
        }

        $notifyMessage = __("admin.notifications.service.service_was_created.{$notifyMessageStatus}");
        toastr()->$notifyMessageStatus($notifyMessage);

        return redirect()->route('admin.services.create');
    }

    /**
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $service = $this->serviceRepository->findServiceByIdToEdit($id);

        return view('admin.services.edit', compact('service'));
    }

    /**
     * @param UpdateServiceRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateServiceRequest $request, int $id)
    {
        $notifyMessageStatus = 'success';

        try {
            $this->servicesManager->updateServiceById($request, $id);
        } catch (\Exception $e) {
            $notifyMessageStatus = 'error';

            Log::error('App.Http.Controllers.Admin.Services.ServicesController.update',
                [
                    'data' => [
                        'message' => $e->getMessage(),
                    ],
                ]
            );
        }

        $notifyMessage = __("admin.notifications.service.service_was_updated.{$notifyMessageStatus}");
        toastr()->$notifyMessageStatus($notifyMessage);

        return redirect()->route('admin.services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
