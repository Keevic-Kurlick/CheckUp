<?php

namespace App\Services\PdfConverter\Interfaces;

interface PdfConverterManagerInterface
{
    /**
     * @return void
     */
    public function convert(): void;
}