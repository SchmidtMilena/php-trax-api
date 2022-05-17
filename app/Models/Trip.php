<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\OwnerScope;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    private const DECIMAL_POINT_DELIMITER = 100;

    private const FLOAT_PRECISION = 2;

    protected $casts = [
        'user_id' => 'integer',
        'car_id' => 'integer',
        'date' => 'datetime',
        'miles' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function setMilesAttribute($value): void
    {
        $this->attributes['miles'] = round($value, self::FLOAT_PRECISION) * self::DECIMAL_POINT_DELIMITER;
    }

    public function getDateAttribute($value): CarbonImmutable
    {
        return new CarbonImmutable($value);
    }

    public function getMilesAttribute($value): ?float
    {
        return $value ? $value/self::DECIMAL_POINT_DELIMITER : null;
    }

    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope());
    }
}
