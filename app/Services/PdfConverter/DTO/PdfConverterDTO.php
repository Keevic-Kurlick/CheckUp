<?php

namespace App\Services\PdfConverter\DTO;

use App\Services\PdfConverter\Exceptions\DTO\EmptyPathToFileException;
use App\Services\PdfConverter\Exceptions\DTO\EmptyPathToResultException;
use App\Services\PdfConverter\Exceptions\DTO\WrongFileExtensionException;
use App\Services\PdfConverter\Interfaces\BasePdfConverterDTOInterface;

class PdfConverterDTO implements BasePdfConverterDTOInterface
{
    /** @var string */
    public const FILE_EXTENSION_WORD2007    = 'Word2007';

    /** @var string */
    public const FILE_EXTENSION_ODText      = 'ODText';

    /** @var string */
    public const FILE_EXTENSION_RTF         = 'RTF';

    /** @var string */
    public const FILE_EXTENSION_HTML        = 'HTML';

    /** @var string[] */
    public const ALLOWED_FILE_EXTENSIONS = [
        self::FILE_EXTENSION_WORD2007,
        self::FILE_EXTENSION_ODText,
        self::FILE_EXTENSION_RTF,
        self::FILE_EXTENSION_HTML,
    ];

    /** @var string */
    private string $pathToFile;

    /** @var string */
    private string $fileExtension;

    /** @var string */
    private string $pathToResult;

    /**
     * @param string $file
     * @return PdfConverterDTO
     */
    public function setPathToFile(string $file): static
    {
        $this->pathToFile = $file;
        return $this;
    }

    /**
     * @param string $extension
     * @return $this
     * @throws WrongFileExtensionException
     */
    public function setFileExtension(string $extension): static
    {
        if (!in_array($extension, self::ALLOWED_FILE_EXTENSIONS)) {
            throw new WrongFileExtensionException('Wrong file extension was entered.');
        }

        $this->fileExtension = $extension;

        return $this;
    }

    /**
     * @param string $file
     * @return PdfConverterDTO
     */
    public function setPathToResult(string $file): static
    {
        $this->pathToResult = $file;
        return $this;
    }

    /**
     * @return string
     * @throws
     */
    public function getPathToFile(): string
    {
        if (empty($this->pathToFile)) {
            throw new EmptyPathToFileException('Empty path to source file.');
        }

        return $this->pathToFile;
    }

    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    /**
     * @return string
     * @throws EmptyPathToResultException
     */
    public function getPathToResult(): string
    {
        if (empty($this->pathToResult)) {
            throw new EmptyPathToResultException('Empty path to PDF result.');
        }

        return $this->pathToResult;
    }
}