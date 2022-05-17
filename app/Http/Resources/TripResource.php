<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Services\DomainModels\Trip;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TripResource extends ResourceCollection
{
    public function toArray($request): array
    {
        /** @var Trip $trip */
        $trip = $this;

        return [

        ];
    }
}
