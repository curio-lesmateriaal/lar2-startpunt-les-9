<?php

namespace App\Models;

use Database\Factories\ArtistFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'genre', 'spotify_url', 'soundcloud_url'])]
class Artist extends Model
{
    /** @use HasFactory<ArtistFactory> */
    use HasFactory;

    public function festivals(): BelongsToMany
    {
        return $this->belongsToMany(Festival::class)->withTimestamps();
    }
}
