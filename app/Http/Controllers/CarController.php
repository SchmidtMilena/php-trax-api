<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CarCollectionResource;
use App\Http\Resources\CarResource;
use App\Services\Repositories\Contracts\CarRepositoryContract;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCarRequest;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Car;

class CarController extends Controller
{
    private const STORE_REQUEST_FIELDS = [
        'year',
        'make',
        'model',
    ];

    private $carRepository;

    public function __construct(CarRepositoryContract $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return CarCollectionResource::collection($this->carRepository->findForUser());
    }

    public function show(Car $car): Responsable
    {
        return new CarResource($this->carRepository->show((int) $car->id));
    }

    public function store(StoreCarRequest $request)
    {
        $data = $request->only(self::STORE_REQUEST_FIELDS);
        $data['user_id'] = Auth::id();

        try {
            $this->carRepository->store($data);
            $code = Response::HTTP_CREATED;
        } catch (HttpException $httpException) {
            $code = $httpException->getCode();
        } catch (Exception $e) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            return new JsonResponse([], $code);
        }
    }

    public function destroy(Car $car): JsonResponse
    {
        $user = Auth::user();

        if(!$user->can('delete', $car)) {
            return new JsonResponse([], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        try {
            $this->carRepository->delete($car->id);
            $code = Response::HTTP_OK;
        } catch (HttpException $httpException) {
            $code = $httpException->getCode();
        } catch (Exception $e) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            return new JsonResponse([], $code);
        }
    }
}
