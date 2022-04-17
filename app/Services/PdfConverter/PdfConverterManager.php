<?php

namespace App\Services\PdfConverter;

use App\Services\PdfConverter\Interfaces\BasePdfConverterDTOInterface;
use App\Services\PdfConverter\Interfaces\PdfConverterInterface;
use App\Services\PdfConverter\Interfaces\PdfConverterManagerInterface;

class PdfConverterManager implements PdfConverterManagerInterface
{
    /** @var BasePdfConverterDTOInterface */
    private BasePdfConverterDTOInterface $basePdfConverterDTO;

    /** @var PdfConverterInterface */
    private PdfConverterInterface $pdfConverter;

    /**
     * @param BasePdfConverterDTOInterface $basePdfConverterDTO
     */
    public function __construct(BasePdfConverterDTOInterface $basePdfConverterDTO)
    {
        $this->basePdfConverterDTO = $basePdfConverterDTO;
        $this->pdfConverter = \App::make(PdfConverterInterface::class);
    }

    /**
     * @return void
     */
    public function convert(): void
    {
        $this->pdfConverter
            ->setBasePdfConverterDTO($this->basePdfConverterDTO)
            ->run();
    }
}