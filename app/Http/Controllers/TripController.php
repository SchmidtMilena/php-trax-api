<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Services\Repositories\Contracts\TripRepositoryContract;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TripController extends Controller
{
    private const DECIMAL_POINT_MULTIPLIER = 100;

    private const STORE_REQUEST_FIELDS = [
        'date',
        'car_id',
        'miles',
    ];

    private const FLOAT_PRECISION = 2;

    private $tripRepository;

    public function __construct(TripRepositoryContract $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function index(): TripResource
    {
        return new TripResource($this->tripRepository->findForUser());
    }

    public function store(StoreTripRequest $request): JsonResponse
    {
        $data = $request->only(self::STORE_REQUEST_FIELDS);
        $data['userId'] = Auth::id();

        try {
            $this->tripRepository->store($data);
            $code = Response::HTTP_CREATED;
        } catch (HttpException $httpException) {
            $code = $httpException->getCode();
        } catch (Exception $e) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            return new JsonResponse([], $code);
        }
    }
}
