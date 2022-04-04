<?php

namespace App\Services\DocxProcessor\Interfaces;

interface DocxProcessorInterface
{
    /**
     * @return string
     */
    public function run(): string;
}