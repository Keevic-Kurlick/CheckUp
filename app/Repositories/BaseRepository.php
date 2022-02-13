<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /** @var Model */
    protected Model $model;

    /**  */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model
     */
    protected function startCondition(): Model
    {
        return clone $this->model;
    }
}