<?php

namespace App\Repositories\Orders;

use App\Repositories\BaseRepository;
use App\Models\MedicalCertificate as Model;

class MedicalCertificatesRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}