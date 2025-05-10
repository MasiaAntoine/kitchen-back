<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'mac_address',
        'last_update',
        'name',
    ];

    protected $casts = [
        'last_update' => 'datetime',
    ];

    public function ingredient(): HasOne
    {
        return $this->hasOne(Ingredient::class);
    }

    public function isOnline(): bool
    {
        if (!$this->last_update) {
            return false;
        }

        // On considère la balance connectée si elle a été mise à jour dans les 5 dernières minutes
        return $this->last_update->diffInMinutes(now()) < 5;
    }
}
