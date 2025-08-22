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
            'balance_id' => $this->balance_id,
            'type' => $this->whenLoaded('type', function () {
                return [
                    'id' => $this->type->id,
                    'name' => $this->type->name,
                ];
            }),
            'measure' => $this->whenLoaded('measure', function () {
                return [
                    'id' => $this->measure->id,
                    'name' => $this->measure->name,
                    'symbol' => $this->measure->symbol,
                ];
            }),
        ];
    }
}
