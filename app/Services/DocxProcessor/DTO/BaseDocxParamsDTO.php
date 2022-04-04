<?php

namespace App\Services\DocxProcessor\DTO;

use App\Services\DocxProcessor\Exceptions\DTO\EmptyResultNameException;
use App\Services\DocxProcessor\Exceptions\DTO\EmptyTemplateNameException;
use App\Services\DocxProcessor\Interfaces\DTO\BaseDocxParamsInterface;
use ReflectionProperty;

abstract class BaseDocxParamsDTO implements BaseDocxParamsInterface
{
    /** @var string */
    private string $templateName;

    /** @var string */
    private string $resultName;

    /**
     * @param string $templateName
     * @param string $resultName
     * @return static
     */
    public static function make(string $templateName, string $resultName): static {
        return new static($templateName, $resultName);
    }

    /**
     * @param string $templateName
     * @param string $resultName
     */
    public function __construct(string $templateName, string $resultName)
    {
        $this->templateName = $templateName;
        $this->resultName = $resultName;
    }

    /**
     * @return string
     * @throws EmptyTemplateNameException
     */
    public function getPathToTemplate(): string
    {
        if (empty($this->templateName)) {
            throw new EmptyTemplateNameException('`templateName` property not entered.');
        }

        return static::getBasePathToTemplate() . 'templates/' . $this->templateName . '.docx';
    }

    /**
     * @return string
     * @throws EmptyResultNameException
     */
    public function getPathToSaveResult(): string
    {
        if (empty($this->templateName)) {
            throw new EmptyResultNameException('`resultName` property not entered.');
        }

        return static::getBasePathToTemplate() . 'results/' . $this->resultName . '.docx';
    }

    /**
     * @return array
     */
    public function getValuesForTemplate(): array {
        $valuesForTemplate = [];

        $prodClass  = new \ReflectionClass(static::class);
        $properties =  $prodClass->getProperties();

        /** @var ReflectionProperty $property */
        foreach ($properties as $property) {
            $methodName = 'get' . ucfirst($property->getName());

            if ($prodClass->hasMethod($methodName)) {
                $methodResult = $this->$methodName();

                if (!empty($methodResult)) {
                    $valuesForTemplate = array_merge($valuesForTemplate, [
                        $methodResult->getTemplateKey() => $methodResult->getValue()
                    ]);
                }
            }
        }

        return $valuesForTemplate;
    }

    /**
     * @param string $resultName
     * @return BaseDocxParamsDTO
     */
    public function setResultName(string $resultName): static
    {
        $this->resultName = $resultName;
        return $this;
    }

    /**
     * @param string $templateName
     * @return BaseDocxParamsDTO
     */
    public function setTemplateName(string $templateName): static
    {
        $this->templateName = $templateName;
        return $this;
    }

    /**
     * @return string
     */
    abstract protected function getBasePathToTemplate(): string;
}