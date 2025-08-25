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
        'place_type_id',
        'quantity',
        'max_quantity',
        'measurement_unit_id',
    ];

    protected $casts = [
        'quantity' => 'float',
        'max_quantity' => 'float',
    ];

    public function getIsConnectedAttribute(): bool
    {
        return !empty($this->connected_scale_id);
    }

    public function placeType(): BelongsTo
    {
        return $this->belongsTo(PlaceType::class);
    }

    public function measurementUnit(): BelongsTo
    {
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function connectedScale(): BelongsTo
    {
        return $this->belongsTo(ConnectedScale::class, 'connected_scale_id');
    }
}
