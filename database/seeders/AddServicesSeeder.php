<?php

namespace Database\Seeders;

use App\Models\Medical_certificate;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddServicesSeeder extends Seeder
{
    /**
     * @throws \Throwable
     */
    public function run()
    {
        DB::beginTransaction();

        $forCreate = [
            [
                'med_sert' => [
                    'name'          => 'Справка №62',
                    'description'   => 'Справка для плавания.',
                ],
                'service' => [
                    'name'          => 'Заказ справки №62',
                    'description'   => 'Справка для плавания универсальная.',
                    'price'         => 1500
                ],
            ],
        ];

        $this->createServices($forCreate);

        DB::commit();
    }

    /**
     * @param $servicesInfo
     */
    private function createServices($servicesInfo) {

        foreach ($servicesInfo as $item) {
            $medCertInfo    = $item['med_sert'];
            $serviceInfo    = $item['service'];

            $medicalCertificate                 = new Medical_certificate();
            $medicalCertificate->name           = $medCertInfo['name'];
            $medicalCertificate->description    = $medCertInfo['description'];
            $medicalCertificate->save();

            $service                        = new Service();
            $service->name                  = $serviceInfo['name'];
            $service->description           = $serviceInfo['description'];
            $service->price                 = $serviceInfo['price'];
            $service->medical_certificate   = $medicalCertificate->id;
            $service->save();
        }
    }
}
