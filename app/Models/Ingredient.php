<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'balance_id',
        'type_id',
        'quantity',
        'max_quantity',
        'measure_id',
        'balance_id',
    ];

    protected $casts = [
        'quantity' => 'float',
        'max_quantity' => 'float',
    ];

    public function getIsConnectedAttribute(): bool
    {
        return !empty($this->balance_id);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function measure(): BelongsTo
    {
        return $this->belongsTo(Measure::class);
    }

    public function balance(): BelongsTo
    {
        return $this->belongsTo(Balance::class);
    }
}
