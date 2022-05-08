<?php

namespace App\Services\DocxProcessor;

use App\Services\DocxProcessor\DTO\BaseDocxParamsDTO;
use App\Services\DocxProcessor\Exceptions\DocxProcessorException;
use App\Services\DocxProcessor\Interfaces\DocxProcessorInterface;
use PhpOffice\PhpWord\TemplateProcessor;

class DocxProcessorService implements DocxProcessorInterface
{
    /** @var BaseDocxParamsDTO $docxProcessorDTO */
    private BaseDocxParamsDTO $docxProcessorDTO;

    /**
     * @param BaseDocxParamsDTO $docxProcessorDTO
     * @return DocxProcessorService
     */
    public function setDocxProcessorDTO(BaseDocxParamsDTO $docxProcessorDTO): static
    {
        $this->docxProcessorDTO = $docxProcessorDTO;

        return $this;
    }

    /**
     * @return string
     * @throws Exceptions\DTO\EmptyResultPathException
     * @throws Exceptions\DTO\EmptyTemplateNameException
     * @throws DocxProcessorException
     */
    public function run(): string
    {
        $pathToTemplate = $this->docxProcessorDTO->getPathToTemplate();
        $pathToResult   = $this->docxProcessorDTO->getPathToSaveResult();
        $templateValues = $this->docxProcessorDTO->getValuesForTemplate();

        $absolutePathToTemplate = \Storage::path($pathToTemplate);
        $absolutePathToResult   = \Storage::path($pathToResult);

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