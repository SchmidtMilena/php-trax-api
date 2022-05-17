<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Services\DomainModels\Car;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CarResource extends ResourceCollection
{
    public function toArray($request): array
    {
        /** @var Car $car */
        $car = $this;

        return [

        ];
    }
}
