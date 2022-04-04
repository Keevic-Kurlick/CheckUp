<?php

namespace App\Services\DocxProcessor\Interfaces\ValueObjects;

interface ValueObjectInterface
{
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
    public function getTemplateKey(): string;
}