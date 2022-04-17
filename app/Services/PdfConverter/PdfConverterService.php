<?php

namespace App\Services\PdfConverter;

use App\Services\PdfConverter\Interfaces\BasePdfConverterDTOInterface;
use App\Services\PdfConverter\Interfaces\PdfConverterInterface;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

class PdfConverterService implements PdfConverterInterface
{
    /** @var string */
    private string $rendererName;

    /** @var string */
    private string $rendererLibraryPath;

    /** @var string */
    private string $defaultFontName;

    /** @var BasePdfConverterDTOInterface */
    private BasePdfConverterDTOInterface $basePdfConverterDTO;

    public function __construct()
    {
        $this->rendererName         = config('pdfConverter.pdf_renderer');
        $this->rendererLibraryPath  = config('pdfConverter.renderer_library_path');
        $this->defaultFontName      = config('pdfConverter.defaultFontName');
    }

    /**
     * @param BasePdfConverterDTOInterface $basePdfConverterDTO
     * @return PdfConverterService
     */
    public function setBasePdfConverterDTO(BasePdfConverterDTOInterface $basePdfConverterDTO): static
    {
        $this->basePdfConverterDTO  = $basePdfConverterDTO;
        return $this;
    }

    /**
     * @return void
     * @throws \PhpOffice\PhpWord\Exception\Exception
     */
    public function run(): void
    {
        $pathToFile     = storage_path($this->basePdfConverterDTO->getPathToFile());
        $pathToResult   = storage_path($this->basePdfConverterDTO->getPathToResult());

        Settings::setPdfRenderer($this->rendererName, $this->rendererLibraryPath);

        $phpWord = IOFactory::load(
            $pathToFile,
            $this->basePdfConverterDTO->getFileExtension()
        );

        $phpWord->setDefaultFontName($this->defaultFontName);

        $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
        $pdfWriter->save($pathToResult);
    }
}