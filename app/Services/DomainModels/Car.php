<?php

declare(strict_types=1);

namespace App\Services\DomainModels;

class Car
{
    private const DECIMAL_POINT_DELIMITER = 100;

    private $id;
    private $userId;
    private $year;
    private $make;
    private $model;
    private $trips;
    private $miles;

    public function __construct(int $id, int $userId, int $year, string $make, string $model, ?int $trips, ?int $miles) {
        $this->id = $id;
        $this->userId = $userId;
        $this->year = $year;
        $this->make = $make;
        $this->model = $model;
        $this->trips = $trips;
        $this->miles = $miles;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getTrips(): ?int
    {
        return $this->trips;
    }

    public function getMiles(): ?float
    {
        return $this->miles ? $this->miles/self::DECIMAL_POINT_DELIMITER : null;
    }
}
