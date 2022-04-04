<?php

namespace App\Services\DocxProcessor\ValueObjects\MedicalCertificate;

use App\Services\DocxProcessor\Interfaces\ValueObjects\ValueObjectInterface;

class PatientPassportSeries implements ValueObjectInterface
{
    /** @var string */
    private string $patientPassportSeries;

    /** @var string */
    private const TEMPLATE_KEY = '${patientPassportSeries}';

    /**
     * @param string $patientPassportSeries
     */
    public function __construct(string $patientPassportSeries)
    {
        $this->patientPassportSeries = $patientPassportSeries;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->patientPassportSeries;
    }

    /**
     * @return bool
     */
    public function hasValue(): bool
    {
        return (bool) $this->patientPassportSeries;
    }

    /**
     * @return string
     */
    public function getTemplateKey(): string
    {
        return self::TEMPLATE_KEY;
    }
}