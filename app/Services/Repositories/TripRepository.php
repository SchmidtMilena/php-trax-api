<?php

declare(strict_types=1);

namespace App\Services\Repositories;

use App\Services\Repositories\Contracts\TripRepositoryContract;
use Illuminate\Support\Collection;

final class TripRepository implements TripRepositoryContract
{
    public function findForUser(int $userId): Collection
    {

    }

    public function store(array $data): void
    {

    }
}
