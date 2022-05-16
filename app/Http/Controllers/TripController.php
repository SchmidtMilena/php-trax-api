<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripResource;
use Illuminate\Http\Request;
use App\Services\Repositories\Contracts\TripRepositoryContract;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    private TripRepositoryContract $tripRepository;

    public function __construct(TripRepositoryContract $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function index(): TripResource
    {
        return new TripResource([]);
    }

    public function store(StoreTripRequest $request): JsonResponse
    {

    }
}
