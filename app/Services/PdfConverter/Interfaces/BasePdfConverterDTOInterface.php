<?php

namespace App\Services\PdfConverter\Interfaces;

interface BasePdfConverterDTOInterface
{
    /**
     * @param string $file
     * @return $this
     */
    public function setPathToFile(string $file): static;

    /**
     * @param string $extension
     * @return $this
     */
    public function setFileExtension(string $extension): static;

    /**
     * @param string $file
     * @return $this
     */
    public function setPathToResult(string $file): static;

    /**
     * @return string
     */
    public function getPathToFile(): string;

    /**
     * @return string
     */
    public function getFileExtension(): string;

    /**
     * @return string
     */
    public function getPathToResult(): string;
}