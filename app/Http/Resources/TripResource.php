<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Services\DomainModels\Trip;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Trip $trip */
        $trip = $this;
        $car = $trip->getCar();

        return [
            'id'  => $trip->getId(),
            'date' => $trip->getDate(),
            'miles' => $trip->getMiles(),
            'total' => 'no idea where it comes from',
            'car' => [
                'id' => $car->getId(),
                'make' => $car->getMake(),
                'model' => $car->getModel(),
                'year' => $car->getYear()
            ]
        ];
    }
}
