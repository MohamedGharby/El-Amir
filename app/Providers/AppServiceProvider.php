<?php

namespace App\Providers;

use Core\Services\FileService;
use Illuminate\Support\ServiceProvider;
use Core\Interfaces\FileServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(FileServiceInterface::class, FileService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
