<?php

namespace App\Services\PdfConverter\Interfaces;

interface PdfConverterInterface
{
    /**
     * @param BasePdfConverterDTOInterface $pdfConverterDTO
     * @return static
     */
    public function setPdfConverterDTO(BasePdfConverterDTOInterface $pdfConverterDTO): static;

    /**
     * @return void
     */
    public function run(): void;
}