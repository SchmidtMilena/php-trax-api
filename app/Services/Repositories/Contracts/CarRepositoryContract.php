<?php

declare(strict_types=1);

namespace App\Services\Repositories\Contracts;

use Illuminate\Support\Collection;

interface CarRepositoryContract
{
    public function findForUser(): Collection;

    public function store(array $data): void;

    public function delete(int $id): void;
}
