<?php

namespace App\Services\PdfConverter;

use App\Services\PdfConverter\Interfaces\BasePdfConverterDTOInterface;
use App\Services\PdfConverter\Interfaces\PdfConverterInterface;
use Illuminate\Support\Facades\Storage;
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
    private BasePdfConverterDTOInterface $pdfConverterDTO;

    public function __construct()
    {
        $this->rendererName         = config('pdfConverter.pdf_renderer');
        $this->rendererLibraryPath  = config('pdfConverter.renderer_library_path');
        $this->defaultFontName      = config('pdfConverter.defaultFontName');
    }

    /**
     * @param BasePdfConverterDTOInterface $pdfConverterDTO
     * @return PdfConverterService
     */
    public function setPdfConverterDTO(BasePdfConverterDTOInterface $pdfConverterDTO): static
    {
        $this->pdfConverterDTO  = $pdfConverterDTO;
        return $this;
    }

    /**
     * @return string
     * @throws \PhpOffice\PhpWord\Exception\Exception
     */
    public function run(): string
    {
        $pathToFile     = Storage::path($this->pdfConverterDTO->getPathToFile());
        $pathToResult   = Storage::path($this->pdfConverterDTO->getPathToResult());

        Settings::setPdfRenderer($this->rendererName, $this->rendererLibraryPath);

        $phpWord = IOFactory::load(
            $pathToFile,
            $this->pdfConverterDTO->getFileExtension()
        );

        $phpWord->setDefaultFontName($this->defaultFontName);

        $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
        $pdfWriter->save($pathToResult);

        return $pathToResult;
    }
}