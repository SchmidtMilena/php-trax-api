<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Services\Repositories\Contracts\CarRepositoryContract;
use Illuminate\Http\Request;
use App\Services\Repositories\Contracts\TripRepositoryContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\StoreCarRequest;

class CarController extends Controller
{
    private CarRepositoryContract $carRepository;

    public function __construct(CarRepositoryContract $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index(): CarResource
    {
        return new CarResource([]);
    }

    public function store(StoreCarRequest $request): JsonResponse
    {

    }

    public function destroy(): JsonResponse
    {

    }
}
