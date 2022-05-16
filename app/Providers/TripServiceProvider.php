<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Repositories\Contracts\TripRepositoryContract;
use App\Services\Repositories\TripRepository;
use Illuminate\Support\ServiceProvider;

class TripServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TripRepositoryContract::class, TripRepository::class);
    }
}
