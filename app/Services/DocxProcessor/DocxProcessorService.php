<?php

namespace App\Services\DocxProcessor;

use App\Services\DocxProcessor\DTO\BaseDocxParamsDTO;
use App\Services\DocxProcessor\Exceptions\DocxProcessorException;
use App\Services\DocxProcessor\Interfaces\DocxProcessorInterface;
use PhpOffice\PhpWord\TemplateProcessor;

class DocxProcessorService implements DocxProcessorInterface
{
    /**
     * @param BaseDocxParamsDTO $docxProcessorDTO
     */
    public function __construct(
        private BaseDocxParamsDTO $docxProcessorDTO
    ) {}

    /**
     * @return string
     * @throws Exceptions\DTO\EmptyResultNameException
     * @throws Exceptions\DTO\EmptyTemplateNameException
     * @throws DocxProcessorException
     */
    public function run(): string
    {
        $pathToTemplate = $this->docxProcessorDTO->getPathToTemplate();
        $pathToResult   = $this->docxProcessorDTO->getPathToSaveResult();
        $templateValues = $this->docxProcessorDTO->getValuesForTemplate();

        $absolutePathToTemplate = storage_path($pathToTemplate);
        $absolutePathToResult   = storage_path($pathToResult);

        try {
            $templateProcessor = new TemplateProcessor($absolutePathToTemplate);
            $templateProcessor->setValues($templateValues);
            $templateProcessor->saveAs($absolutePathToResult);
        } catch (\Exception $e) {
            throw new DocxProcessorException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious(),
            );
        }

        return $pathToResult;
    }
}