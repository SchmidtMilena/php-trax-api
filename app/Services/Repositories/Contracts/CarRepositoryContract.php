<?php

declare(strict_types=1);

namespace App\Services\Repositories\Contracts;

use App\Services\DomainModels\Car;
use Illuminate\Support\Collection;

interface CarRepositoryContract
{
    public function findForUser(): Collection;

    public function show(int $id): Car;

    public function store(array $data): void;

    public function delete(int $id): void;
}
