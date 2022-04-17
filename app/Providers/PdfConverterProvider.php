<?php

namespace App\Providers;

use App\Services\PdfConverter\Interfaces\PdfConverterInterface;
use App\Services\PdfConverter\PdfConverterService;
use Illuminate\Support\ServiceProvider;

class PdfConverterProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(PdfConverterInterface::class, PdfConverterService::class);
    }
}
