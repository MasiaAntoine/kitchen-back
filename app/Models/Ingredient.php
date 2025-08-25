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
        'connected_scale_id',
        'type_id',
        'quantity',
        'max_quantity',
        'measure_id',
    ];

    protected $casts = [
        'quantity' => 'float',
        'max_quantity' => 'float',
    ];

    public function getIsConnectedAttribute(): bool
    {
        return !empty($this->connected_scale_id);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function measure(): BelongsTo
    {
        return $this->belongsTo(Measure::class);
    }

    public function connectedScale(): BelongsTo
    {
        return $this->belongsTo(ConnectedScale::class, 'connected_scale_id');
    }
}
