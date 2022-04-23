<?php

namespace App\Services\DocxProcessor\ValueObjects\MedicalCertificate;

use App\Services\DocxProcessor\Interfaces\ValueObjects\ValueObjectInterface;

class PatientPassportNumber implements ValueObjectInterface
{
    /** @var string */
    private string $patientPassportNumber;

    /** @var string NAME */
    private const NAME = 'Номер паспорта пациента';

    /** @var string */
    private const TEMPLATE_KEY = '${patientPassportNumber}';

    /**
     * @param string $patientPassportNumber
     */
    public function __construct(string $patientPassportNumber)
    {
        $this->patientPassportNumber = $patientPassportNumber;
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return self::NAME;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->patientPassportNumber;
    }

    /**
     * @return bool
     */
    public function hasValue(): bool
    {
        return (bool) $this->patientPassportNumber;
    }

    /**
     * @return string
     */
    public static function getTemplateKey(): string
    {
        return self::TEMPLATE_KEY;
    }
}