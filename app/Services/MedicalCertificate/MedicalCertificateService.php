<?php

namespace App\Services\MedicalCertificate;

use App\Services\DocxProcessor\DTO\MedicalCertificateDocxParamsDTO;
use App\Services\DocxProcessor\Interfaces\DocxProcessorInterface;
use App\Services\MedicalCertificate\Interfaces\MedicalCertificateServiceInterface;

class MedicalCertificateService implements MedicalCertificateServiceInterface
{
    /** @var DocxProcessorInterface $docxProcessor */
    private DocxProcessorInterface $docxProcessor;

    /**
     * @param DocxProcessorInterface $docxProcessor
     */
    public function __construct(DocxProcessorInterface $docxProcessor)
    {
        $this->docxProcessor = $docxProcessor;
    }

    /**
     * @param MedicalCertificateDocxParamsDTO $medicalCertificateDocxParamsDTO
     * @throws \Exception
     */
    public function generate(MedicalCertificateDocxParamsDTO $medicalCertificateDocxParamsDTO)
    {
        $this->docxProcessor->setDocxProcessorDTO($medicalCertificateDocxParamsDTO);
        $this->docxProcessor->run();
    }
}