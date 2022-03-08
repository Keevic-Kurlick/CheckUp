<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Requests\Admin\Services\StoreServiceRequest;
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

}