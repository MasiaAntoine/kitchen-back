<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
   /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'quantity' => $this->quantity,
            'max_quantity' => $this->max_quantity,
            'connected_scale_id' => $this->connected_scale_id,
            'place_type' => $this->whenLoaded('placeType', function () {
                return [
                    'id' => $this->placeType->id,
                    'name' => $this->placeType->name,
                ];
            }),
            'measurement_unit' => $this->whenLoaded('measurementUnit', function () {
                return [
                    'id' => $this->measurementUnit->id,
                    'name' => $this->measurementUnit->name,
                    'symbol' => $this->measurementUnit->symbol,
                ];
            }),
        ];
    }
}
