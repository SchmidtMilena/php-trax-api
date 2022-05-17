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

    }

    public function store(array $data): void
    {

    }

    public function delete(int $id): void
    {

    }

    private function mapToDomainModel(CarModel $car): Car
    {

    }

}
