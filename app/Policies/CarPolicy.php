<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Car;
use App\Models\User;

class CarPolicy
{
    public function delete(Car $car, User $user): bool
    {
        return $user->id === $car->user_id;
    }
}

