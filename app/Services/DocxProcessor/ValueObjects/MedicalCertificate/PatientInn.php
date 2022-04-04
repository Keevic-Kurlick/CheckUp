<?php

namespace App\Services\DocxProcessor\ValueObjects\MedicalCertificate;

use App\Services\DocxProcessor\Interfaces\ValueObjects\ValueObjectInterface;

class PatientInn implements ValueObjectInterface
{
    /** @var string */
    private string $patientInn;

    /** @var string */
    private const TEMPLATE_KEY = '${patientInn}';

    /**
     * @param string $patientInn
     */
    public function __construct(string $patientInn)
    {
        $this->patientInn = $patientInn;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->patientInn;
    }

    /**
     * @return bool
     */
    public function hasValue(): bool
    {
        return (bool) $this->patientInn;
    }

    /**
     * @return string
     */
    public function getTemplateKey(): string
    {
        return self::TEMPLATE_KEY;
    }
}