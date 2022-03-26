<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Requests\Admin\Services\StoreServiceRequest;
use App\Http\Requests\Admin\Services\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServicesManager
{
    /**
     * @param StoreServiceRequest $request
     * @return void
     * @throws \Throwable
     */
    public function storeService(StoreServiceRequest $request): void
    {
        DB::beginTransaction();

        $service = new Service();
        $service->name = $request->service_name;
        $service->description = $request->service_description;
        $service->price = $request->service_price;
        $service->save();

        DB::commit();
    }

    /**
     * @param UpdateServiceRequest $request
     * @param int $id
     * @return void
     * @throws \Throwable
     */
    public function updateServiceById(UpdateServiceRequest $request, int $id)
    {
        DB::beginTransaction();

            Service::whereId($id)
                ->update([
                    'name'          => $request->service_name,
                    'description'   => $request->service_description,
                    'price'         => $request->service_price,
                ]);

        DB::commit();
    }

    /**
     * @return void
     */
    public function destroyServiceById(int $id)
    {
        DB::beginTransaction();

        Service::whereId($id)->delete();

        DB::commit();
    }
}