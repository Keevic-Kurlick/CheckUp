<?php

namespace App\Services\DocxProcessor\Interfaces;

use App\Services\DocxProcessor\DTO\BaseDocxParamsDTO;

interface DocxProcessorInterface
{
    /**
     * @return string
     * @throws \Exception
     */
    public function run(): string;

    /**
     * @param BaseDocxParamsDTO $docxProcessorDTO
     * @return $this
     */
    public function setDocxProcessorDTO(BaseDocxParamsDTO $docxProcessorDTO): static;
}