<?php

namespace App\Repositories\Admin;

use App\Models\MedicalCertificate;
use App\Models\MedicalCertificate as Model;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * @param int $id
     * @return MedicalCertificate|ModelNotFoundException
     */
    public function getMedicalCertificatesToEdit(int $id): mixed
    {
        /** @var MedicalCertificate|ModelNotFoundException $medicalCertificates */
        $medicalCertificates = $this->startCondition()->findOrFail($id);

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