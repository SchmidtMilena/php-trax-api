<?php

declare(strict_types=1);

namespace App\Services\Repositories;

use App\Services\DomainModels\Car;
use App\Services\DomainModels\Trip;
use App\Services\Repositories\Contracts\TripRepositoryContract;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use App\Models\Trip as TripModel;

final class TripRepository implements TripRepositoryContract
{
    public function findForUser(int $userId): Collection
    {
        return TripModel::where('user_id', $userId)->get()->map(
            function (TripModel $tripModel): Trip {
                return $this->mapToDomainModel($tripModel);
            }
        );
    }

    public function store(array $data): void
    {
        TripModel::create($data);
    }

    private function mapToDomainModel(TripModel $trip): Trip
    {
        /** @var \App\Models\Car $car */
        $car = $trip->car();

        $car = new Car(
            $car->id,
            $car->user_id,
            $car->year,
            $car->make,
            $car->model
        );

        return new Trip(
            $trip->id,
            $trip->user_id,
            $car,
            new CarbonImmutable($trip->date),
            $trip->miles
        );
    }
}
