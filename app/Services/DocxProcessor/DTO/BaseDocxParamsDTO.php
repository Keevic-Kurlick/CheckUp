<?php

namespace App\Services\DocxProcessor\DTO;

use App\Services\DocxProcessor\Exceptions\DTO\CallingTemplateParamsMethodAtBaseDTOClassException;
use App\Services\DocxProcessor\Exceptions\DTO\EmptyResultNameException;
use App\Services\DocxProcessor\Exceptions\DTO\EmptyResultPathException;
use App\Services\DocxProcessor\Exceptions\DTO\EmptyTemplateNameException;
use App\Services\DocxProcessor\Interfaces\DTO\BaseDocxParamsInterface;
use App\Services\DocxProcessor\Interfaces\ValueObjects\ValueObjectInterface;
use ReflectionProperty;

abstract class BaseDocxParamsDTO implements BaseDocxParamsInterface
{
    /** @var string */
    private string $templatePath;

    /** @var string */
    private string $resultPath;

    /** @var string */
    private string $resultName;

    /**
     * @param string $templatePath
     * @param string $resultPath
     * @return static
     */
    public static function make(string $templatePath, string $resultPath): static {
        return new static($templatePath, $resultPath);
    }

    /**
     * @param string $templatePath
     * @param string $resultPath
     */
    private function __construct(string $templatePath, string $resultPath)
    {
        $this->templatePath = $templatePath;
        $this->resultPath = $resultPath;
    }

    /**
     * @param string $resultName
     * @return $this
     */
    public function setResultName(string $resultName): static
    {
        $this->resultName = $resultName;

        return $this;
    }

    /**
     * @return string
     * @throws EmptyTemplateNameException
     */
    public function getPathToTemplate(): string
    {
        if (empty($this->templatePath)) {
            throw new EmptyTemplateNameException('`templateName` property not entered.');
        }

        return $this->templatePath;
    }

    /**
     * @return string
     * @throws EmptyResultPathException
     * @throws EmptyResultNameException
     */
    public function getPathToSaveResult(): string
    {
        if (empty($this->resultPath)) {
            throw new EmptyResultPathException('`resultPath` property not entered.');
        }

        if (empty($this->resultName)) {
            throw new EmptyResultNameException('`resultName` property not entered.');
        }

        return $this->resultPath . $this->resultName . '.docx';
    }

    /**
     * @return string
     */
    abstract protected function getBasePathToTemplate(): string;

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
                        $methodResult::getTemplateKey() => $methodResult->getValue()
                    ]);
                }
            }
        }

        return $valuesForTemplate;
    }

    /**
     * @return array
     * @throws CallingTemplateParamsMethodAtBaseDTOClassException
     */
    public static function getTemplateParams(): array
    {
        if (self::class === static::class) {
            throw new CallingTemplateParamsMethodAtBaseDTOClassException();
        }

        $templateParams = self::mapTemplateParams();

        return $templateParams;
    }

    /**
     * @return array
     */
    private static function mapTemplateParams(): array
    {
        $mappedTemplateParams = [];

        $prodClass  = new \ReflectionClass(static::class);
        /** @var ReflectionProperty[] $properties */
        $properties =  $prodClass->getProperties();

        foreach ($properties as $property) {
            /** @var ValueObjectInterface $propertyValueObjectClass */
            $propertyValueObjectClass = $property->getType()->getName();

            $templateParamName = $propertyValueObjectClass::getName();
            $templateParamTemplateKey = $propertyValueObjectClass::getTemplateKey();

            $mappedTemplateParams[$templateParamTemplateKey] = $templateParamName;
        }

        return $mappedTemplateParams;
    }
}