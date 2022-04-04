<?php

namespace App\Services\DocxProcessor\ValueObjects\MedicalCertificate;

use App\Services\DocxProcessor\Interfaces\ValueObjects\ValueObjectInterface;

class PatientName implements ValueObjectInterface
{
    /** @var string */
    private string $patientName;

    /** @var string */
    private const TEMPLATE_KEY = '${patientName}';

    /**
     * @param string $patientName
     */
    public function __construct(string $patientName)
    {
        $this->patientName = $patientName;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->patientName;
    }

    /**
     * @return bool
     */
    public function hasValue(): bool
    {
        return (bool) $this->patientName;
    }

    /**
     * @return string
     */
    public function getTemplateKey(): string
    {
        return self::TEMPLATE_KEY;
    }
}