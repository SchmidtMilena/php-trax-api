<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Car;
use App\Models\User;

class CarPolicy
{
    public function show(User $user, Car $car): bool
    {
        return $this->checkOwner($user, $car);
    }

    public function delete(User $user, Car $car): bool
    {
        return $this->checkOwner($user, $car);
    }

    private function checkOwner(User $user, Car $car): bool
    {
        return $user->id === $car->user_id;
    }
}

