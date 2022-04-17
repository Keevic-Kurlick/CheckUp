<?php

namespace App\Services\PdfConverter\Interfaces;

interface PdfConverterInterface
{
    /**
     * @param BasePdfConverterDTOInterface $basePdfConverterDTO
     * @return static
     */
    public function setBasePdfConverterDTO(BasePdfConverterDTOInterface $basePdfConverterDTO): static;

    /**
     * @return void
     */
    public function run(): void;
}