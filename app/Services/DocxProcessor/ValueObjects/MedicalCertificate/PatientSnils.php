<?php

namespace App\Services\DocxProcessor\ValueObjects\MedicalCertificate;

use App\Services\DocxProcessor\Interfaces\ValueObjects\ValueObjectInterface;

class PatientSnils implements ValueObjectInterface
{
    /** @var string */
    private string $patientSnils;

    /** @var string */
    private const TEMPLATE_KEY = '${patientSnils}';

    /**
     * @param string $patientSnils
     */
    public function __construct(string $patientSnils)
    {
        $this->patientSnils = $patientSnils;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->patientSnils;
    }

    /**
     * @return bool
     */
    public function hasValue(): bool
    {
        return (bool) $this->patientSnils;
    }

    /**
     * @return string
     */
    public function getTemplateKey(): string
    {
        return self::TEMPLATE_KEY;
    }
}