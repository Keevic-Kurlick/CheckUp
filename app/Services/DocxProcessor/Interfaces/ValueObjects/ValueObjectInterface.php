<?php

namespace App\Services\DocxProcessor\Interfaces\ValueObjects;

interface ValueObjectInterface
{
    /**
     * @return string
     */
    public static function getName(): string;

    /**
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * @return bool
     */
    public function hasValue(): bool;

    /**
     * @return string
     */
    public static function getTemplateKey(): string;
}