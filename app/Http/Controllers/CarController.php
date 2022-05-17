<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CarCollectionResource;
use App\Http\Resources\CarResource;
use App\Services\Repositories\Contracts\CarRepositoryContract;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCarRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;

class CarController extends Controller
{
    private const STORE_REQUEST_FIELDS = [
        'year',
        'make',
        'model',
    ];

    // too bad that this project it on php 7.3 :( if it was >=7.4 I would add types for all properties
    private $carRepository;

    public function __construct(CarRepositoryContract $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return CarCollectionResource::collection($this->carRepository->findForUser());
    }

    // this is not in requirements from readme, but it's needed for checking all functionalities on FE
    public function show(Car $car): CarResource
    {
        return new CarResource($this->carRepository->show((int) $car->id));
    }

    public function store(StoreCarRequest $request): JsonResponse
    {
        $data = $request->only(self::STORE_REQUEST_FIELDS);
        $data['user_id'] = Auth::id();
        $this->carRepository->store($data);

        return new JsonResponse([], Response::HTTP_CREATED);
    }

    public function destroy(Car $car): JsonResponse
    {
        $user = Auth::user();

        if(!$user->can('delete', $car)) {
            return new JsonResponse([], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $this->carRepository->delete($car->id);

        return new JsonResponse([], Response::HTTP_OK);
    }
}
