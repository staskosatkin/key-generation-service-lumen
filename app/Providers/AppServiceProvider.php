<?php

namespace App\Providers;

use App\Contracts\BigReader;
use App\Contracts\HashGenerator;
use App\Contracts\KeyManager as KeysManagerInterface;
use App\Services\KeyManager;
use App\Services\RandomDataAccessor;
use App\Services\RandomHashGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(KeysManagerInterface::class, KeyManager::class);
        $this->app->bind(HashGenerator::class, RandomHashGenerator::class);
        $this->app->bind(BigReader::class, RandomDataAccessor::class);
    }
}
