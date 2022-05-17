<?php

declare(strict_types=1);

namespace App\Services\Repositories;

use App\Services\DomainModels\Car;
use App\Models\Car as CarModel;
use App\Services\DomainModels\Trip;
use App\Services\Repositories\Contracts\TripRepositoryContract;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use App\Models\Trip as TripModel;

final class TripRepository implements TripRepositoryContract
{
    public function findForUser(): Collection
    {
        return TripModel::with('car')->get()->map(
            function (TripModel $tripModel): Trip {
                return $this->mapToDomainModel($tripModel);
            }
        );
    }

    public function store(array $data): void
    {
        $trip = new TripModel();
        $trip->user_id = $data['user_id'];
        $trip->car_id = $data['car_id'];
        $trip->miles = $data['miles'];
        $trip->date = $data['date'];

        $trip->save();
    }

    private function mapToDomainModel(TripModel $trip): Trip
    {
        /** @var CarModel $car */
        $car = $trip->car()->first();

        $car = new Car(
            $car->id,
            $car->user_id,
            $car->year,
            $car->make,
            $car->model,
            null,
            null
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
