<?php

namespace App\Repositories\Admin;

use App\Models\MedicalCertificate as Model;
use App\Repositories\BaseRepository;

class MedicalCertificateRepository extends BaseRepository
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getMedicalCertificatesToIndex(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $medicalCertificates = $this->startCondition()
            ->query()
            ->select(
                [
                    'id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ]
            )
            ->paginate();

        return $medicalCertificates;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}