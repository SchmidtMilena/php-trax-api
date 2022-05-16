<?php

declare(strict_types=1);

namespace App\Services\DomainModels;

class Car
{
    private int $id;
    private int $userId;
    private int $year;
    private string $make;
    private string $model;

    public function __construct(int $id, int $userId, int $year, string $make, string $model) {
        $this->id = $id;
        $this->userId = $userId;
        $this->year = $year;
        $this->make = $make;
        $this->model = $model;
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
}
