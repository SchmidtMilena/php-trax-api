<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    // having mass assigment it's not a good practice but just so you know that I know how it works I implemented it here ;)
    protected $fillable = [
        'user_id',
        'year',
        'make',
        'model',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'year' => 'integer',
        'make' => 'string',
        'model' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class, 'car_id');
    }

    public function getTripsCountAttribute(): ?int
    {
        return $this->trips()->count();
    }

    public function getTripsMilesSumAttribute(): ?int
    {
        return (int) $this->trips()->sum('miles');
    }

    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope());
    }
}
