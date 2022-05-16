<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Repositories\CarRepository;
use App\Services\Repositories\Contracts\CarRepositoryContract;
use Illuminate\Support\ServiceProvider;

class CarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CarRepositoryContract::class, CarRepository::class);
    }
}
