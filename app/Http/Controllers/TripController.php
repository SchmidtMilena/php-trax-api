<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripCollectionResource;
use App\Services\Repositories\Contracts\TripRepositoryContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    private const STORE_REQUEST_FIELDS = [
        'date',
        'car_id',
        'miles',
    ];

    private $tripRepository;

    public function __construct(TripRepositoryContract $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return TripCollectionResource::collection($this->tripRepository->findForUser());
    }

    public function store(StoreTripRequest $request): JsonResponse
    {
        $data = $request->only(self::STORE_REQUEST_FIELDS);
        $data['user_id'] = Auth::id();
        $this->tripRepository->store($data);

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
