<?php

namespace App\Services\DocxProcessor\DTO;

use App\Services\DocxProcessor\ValueObjects\MedicalCertificate\PatientInn;
use App\Services\DocxProcessor\ValueObjects\MedicalCertificate\PatientName;
use App\Services\DocxProcessor\ValueObjects\MedicalCertificate\PatientPassportNumber;
use App\Services\DocxProcessor\ValueObjects\MedicalCertificate\PatientSnils;
use App\Services\DocxProcessor\ValueObjects\MedicalCertificate\PatientPassportSeries;

class MedicalCertificateDocxParamsDTO extends BaseDocxParamsDTO
{
    /** @var string */
    public const BASE_PATH_TO_TEMPLATE = 'app/medical_certificates/';

    /** @var PatientName|null */
    private ?PatientName $patientName = null;

    /** @var PatientPassportSeries|null */
    private ?PatientPassportSeries $patientPassportSeries = null;

    /** @var PatientPassportNumber|null */
    private ?PatientPassportNumber $patientPassportNumber = null;

    /** @var PatientInn|null */
    private ?PatientInn $patientInn = null;

    /** @var PatientSnils|null */
    private ?PatientSnils $patientSnils = null;

    /**
     * @param string $patientName
     * @return MedicalCertificateDocxParamsDTO
     */
    public function setPatientName(string $patientName): MedicalCertificateDocxParamsDTO
    {
        $this->patientName = new PatientName($patientName);
        return $this;
    }

    /**
     * @param string $patientPassportSeries
     * @return MedicalCertificateDocxParamsDTO
     */
    public function setPatientPassportSeries(string $patientPassportSeries): MedicalCertificateDocxParamsDTO
    {
        $this->patientPassportSeries = new PatientPassportSeries($patientPassportSeries);
        return $this;
    }

    /**
     * @param string $patientPassportNumber
     * @return MedicalCertificateDocxParamsDTO
     */
    public function setPatientPassportNumber(string $patientPassportNumber): MedicalCertificateDocxParamsDTO
    {
        $this->patientPassportNumber = new PatientPassportNumber($patientPassportNumber);
        return $this;
    }

    /**
     * @param string $patientInn
     * @return MedicalCertificateDocxParamsDTO
     */
    public function setPatientInn(string $patientInn): MedicalCertificateDocxParamsDTO
    {
        $this->patientInn = new PatientInn($patientInn);
        return $this;
    }

    /**
     * @param string $patientSnils
     * @return MedicalCertificateDocxParamsDTO
     */
    public function setPatientSnils(string $patientSnils): MedicalCertificateDocxParamsDTO
    {
        $this->patientSnils = new PatientSnils($patientSnils);
        return $this;
    }

    /**
     * @return PatientName|null
     */
    public function getPatientName(): ?PatientName
    {
        return $this->patientName;
    }

    /**
     * @return PatientPassportSeries|null
     */
    public function getPatientPassportSeries(): ?PatientPassportSeries
    {
        return $this->patientPassportSeries;
    }

    /**
     * @return PatientPassportNumber|null
     */
    public function getPatientPassportNumber(): ?PatientPassportNumber
    {
        return $this->patientPassportNumber;
    }

    /**
     * @return PatientInn|null
     */
    public function getPatientInn(): ?PatientInn
    {
        return $this->patientInn;
    }

    /**
     * @return PatientSnils|null
     */
    public function getPatientSnils(): ?PatientSnils
    {
        return $this->patientSnils;
    }

    /**
     * @return string
     */
    protected function getBasePathToTemplate(): string
    {
        return self::BASE_PATH_TO_TEMPLATE;
    }
}