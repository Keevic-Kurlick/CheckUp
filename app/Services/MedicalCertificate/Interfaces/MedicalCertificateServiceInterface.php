<?php

namespace App\Services\MedicalCertificate\Interfaces;

use App\Services\DocxProcessor\DTO\MedicalCertificateDocxParamsDTO;

interface MedicalCertificateServiceInterface
{
    /**
     * @param MedicalCertificateDocxParamsDTO $medicalCertificateDocxParamsDTO
     * @throws \Exception
     */
    public function generate(MedicalCertificateDocxParamsDTO $medicalCertificateDocxParamsDTO);
}