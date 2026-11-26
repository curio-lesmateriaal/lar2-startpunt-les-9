<?php

namespace App\Models;

use Database\Factories\LocationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'address', 'city', 'description'])]
class Location extends Model
{
    /** @use HasFactory<LocationFactory> */
    use HasFactory;

    public function festivals(): HasMany
    {
        return $this->hasMany(Festival::class);
    }
}
