<?php

namespace App\Repositories\Admin;

use App\Models\Service as Model;
use App\Repositories\BaseRepository;

class ServiceRepository extends BaseRepository
{
    /** @var MedicalCertificateRepository|\Illuminate\Contracts\Foundation\Application|mixed */
    private MedicalCertificateRepository $medicalCertificateRepository;

    public function __construct() {
        parent::__construct();
        $this->medicalCertificateRepository = app(MedicalCertificateRepository::class);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getServicesToIndex(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $services = $this->startCondition()
            ->query()
            ->select(['id', 'name', 'description', 'price'])
            ->paginate();

        return $services;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findServiceByIdToEdit(int $id): array
    {
        /** @var array $service */
        $service = $this->startCondition()
            ->findOrFail($id)
            ->toArray();

        $medicalCertificate = $this->medicalCertificateRepository
            ->getMedicalCertificateToServiceEditById($service['medical_certificate']);

        $service['medical_certificate'] = $medicalCertificate;

        return $service;
    }

    /**
     * @param int $serviceId
     * @return mixed
     */
    public function getServiceToShow(int $serviceId): mixed
    {
        $service = $this->startCondition()->find($serviceId);

        return $service;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}