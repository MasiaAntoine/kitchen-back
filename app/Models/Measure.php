<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Measure extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'symbol'];

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }
}
