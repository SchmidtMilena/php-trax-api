<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Services\Repositories\Contracts\CarRepositoryContract;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCarRequest;
use Exception;
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

    public function index(): CarResource
    {
        return new CarResource($this->carRepository->findForUser());
    }

    public function store(StoreCarRequest $request): JsonResponse
    {
        $data = $request->only(self::STORE_REQUEST_FIELDS);
        $data['userId'] = Auth::id();

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
