<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Trip;
use App\Models\User;
use App\Models\Car;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripModelTest extends TestCase
{
    use RefreshDatabase;

    private const EXAMPLE_DATE = '05/16/2022';

    private const EXAMPLE_MILES = 11.881;

    private const CORRECT_ROUNDED_VALUE = 11.88;

    private const CORRECT_MUTATED_MILES = 1188;

    public function testInitializeObjectAndGetBasicData(): void
    {
        $trip = new Trip();

        $user = factory(User::class)->create();
        $car = factory(Car::class)->create();

        $trip->user_id = $user->id;
        $trip->car_id = $car->id;
        $trip->miles = self::EXAMPLE_MILES;
        $trip->date = self::EXAMPLE_DATE;

        $trip->save();

        $this->assertDatabaseHas('trips', [
            'id' => $trip->id,
            'miles' => self::CORRECT_MUTATED_MILES
        ]);

        $this->assertSame($trip->miles, self::CORRECT_ROUNDED_VALUE);
        $this->assertTrue($trip->date instanceof CarbonImmutable);
    }
}
