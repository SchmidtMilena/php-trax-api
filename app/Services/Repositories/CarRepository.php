<?php

declare(strict_types=1);

namespace App\Services\Repositories;
use App\Services\DomainModels\Car;
use Illuminate\Support\Collection;
use App\Services\Repositories\Contracts\CarRepositoryContract;
use App\Models\Car as CarModel;

final class CarRepository implements CarRepositoryContract
{
    public function findForUser(int $userId): Collection
    {
        return CarModel::where('user_id', $userId)->get()->map(
            function (CarModel $carModel): Car {
                return $this->mapToDomainModel($carModel);
            }
        );
    }

    public function store(array $data): void
    {
        CarModel::create($data);
    }

    public function delete(int $id): void
    {
        CarModel::destroy($id);
    }

    private function mapToDomainModel(CarModel $car): Car
    {
        return new Car(
            $car->id,
            $car->user_id,
            $car->year,
            $car->make,
            $car->model
        );
    }
}
