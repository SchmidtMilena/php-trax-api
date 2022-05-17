<?php

declare(strict_types=1);

namespace App\Services\Repositories;

use App\Services\DomainModels\Trip;
use App\Services\Repositories\Contracts\TripRepositoryContract;
use Illuminate\Support\Collection;
use App\Models\Trip as TripModel;

final class TripRepository implements TripRepositoryContract
{
    public function findForUser(int $userId): Collection
    {

    }

    public function store(array $data): void
    {

    }

    private function mapToDomainModel(TripModel $trip): Trip
    {

    }
}
