<?php

namespace App\Providers;

use App\Services\MedicalCertificate\Interfaces\MedicalCertificateServiceInterface;
use App\Services\MedicalCertificate\MedicalCertificateService;
use Illuminate\Support\ServiceProvider;

class MedicalCertificateServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(MedicalCertificateServiceInterface::class, MedicalCertificateService::class);
    }
}
