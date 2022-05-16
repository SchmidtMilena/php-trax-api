<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Services\Repositories\Contracts\CarRepositoryContract;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCarRequest;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CarController extends Controller
{
    private const STORE_REQUEST_FIELDS = [
        'year',
        'make',
        'model',
    ];

    private CarRepositoryContract $carRepository;

    public function __construct(CarRepositoryContract $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index(): CarResource
    {
        $userId = Auth::id();

        return new CarResource($this->carRepository->findForUser($userId));
    }

    public function store(StoreCarRequest $request): JsonResponse
    {
        $data = $request->only(self::STORE_REQUEST_FIELDS);
        $data['userId'] = Auth::id();

        try{
            $this->carRepository->store($data);
        } catch(HttpException $httpException) {
            return new JsonResponse([], $httpException->getCode());
        } catch (Exception $e) {
            return new JsonResponse([], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try{
            $this->carRepository->delete($id);
        } catch(HttpException $httpException) {
            return new JsonResponse([], $httpException->getCode());
        } catch (Exception $e) {
            return new JsonResponse([], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
