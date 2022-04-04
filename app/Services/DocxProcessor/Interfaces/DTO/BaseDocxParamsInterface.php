<?php

namespace App\Services\DocxProcessor\Interfaces\DTO;

interface BaseDocxParamsInterface
{
    /**
     * @return string
     */
    public function getPathToTemplate(): string;

    /**
     * @return string
     */
    public function getPathToSaveResult(): string;

    /**
     * @return array
     */
    public function getValuesForTemplate(): array;
}