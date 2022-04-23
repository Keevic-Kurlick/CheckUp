<?php

namespace App\Providers;

use App\Services\DocxProcessor\DocxProcessorService;
use App\Services\DocxProcessor\Interfaces\DocxProcessorInterface;
use Illuminate\Support\ServiceProvider;

class DocxProcessorServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(DocxProcessorInterface::class, DocxProcessorService::class);
    }
}
