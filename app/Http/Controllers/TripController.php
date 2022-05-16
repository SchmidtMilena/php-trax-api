<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Services\Repositories\Contracts\TripRepositoryContract;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TripController extends Controller
{
    private const STORE_REQUEST_FIELDS = [
        'date',
        'car_id',
        'miles',
    ];

    private TripRepositoryContract $tripRepository;

    public function __construct(TripRepositoryContract $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function index(): TripResource
    {
        $userId = Auth::id();

        return new TripResource($this->tripRepository->findForUser($userId));
    }

    public function store(StoreTripRequest $request): JsonResponse
    {
        $data = $request->only(self::STORE_REQUEST_FIELDS);
        $data['userId'] = Auth::id();

        try{
            $this->tripRepository->store($data);
        } catch(HttpException $httpException) {
            return new JsonResponse([], $httpException->getCode());
        } catch (Exception $e) {
            return new JsonResponse([], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
