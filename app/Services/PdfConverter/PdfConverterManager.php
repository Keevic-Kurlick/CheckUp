<?php

namespace App\Services\PdfConverter;

use App\Services\PdfConverter\Interfaces\BasePdfConverterDTOInterface;
use App\Services\PdfConverter\Interfaces\PdfConverterInterface;
use App\Services\PdfConverter\Interfaces\PdfConverterManagerInterface;

class PdfConverterManager implements PdfConverterManagerInterface
{
    /** @var BasePdfConverterDTOInterface */
    private BasePdfConverterDTOInterface $pdfConverterDTO;

    /** @var PdfConverterInterface */
    private PdfConverterInterface $pdfConverter;

    /**
     * @param BasePdfConverterDTOInterface $pdfConverterDTO
     */
    public function __construct(BasePdfConverterDTOInterface $pdfConverterDTO)
    {
        $this->pdfConverterDTO = $pdfConverterDTO;
        $this->pdfConverter = \App::make(PdfConverterInterface::class);
    }

    /**
     * @return string
     */
    public function convert(): string
    {
        $pathToConvertedFile = $this->pdfConverter
            ->setPdfConverterDTO($this->pdfConverterDTO)
            ->run();

        return $pathToConvertedFile;
    }
}