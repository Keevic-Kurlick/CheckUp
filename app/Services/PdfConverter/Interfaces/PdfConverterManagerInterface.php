<?php

namespace App\Services\PdfConverter\Interfaces;

interface PdfConverterManagerInterface
{
    /**
     * @return string
     */
    public function convert(): string;
}