<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Services\DomainModels\Car;
use Illuminate\Http\Resources\Json\JsonResource;

class CarCollectionResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Car $car */
        $car = $this;

        return [
            'id' => $car->getId(),
            'make' => $car->getMake(),
            'model' => $car->getModel(),
            'year' => $car->getYear()
        ];
    }
}
