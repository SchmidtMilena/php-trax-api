<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
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
}
