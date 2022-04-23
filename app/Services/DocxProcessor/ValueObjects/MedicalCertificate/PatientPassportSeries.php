<?php

namespace App\Services\DocxProcessor\ValueObjects\MedicalCertificate;

use App\Services\DocxProcessor\Interfaces\ValueObjects\ValueObjectInterface;

class PatientPassportSeries implements ValueObjectInterface
{
    /** @var string */
    private string $patientPassportSeries;

    /** @var string NAME */
    private const NAME = 'Серия паспорта пациента';

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
    public static function getName(): string
    {
        return self::NAME;
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
    public static function getTemplateKey(): string
    {
        return self::TEMPLATE_KEY;
    }
}