<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Services\StoreServiceRequest;
use App\Repositories\Admin\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yoeunes\Toastr\Facades\Toastr;

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
