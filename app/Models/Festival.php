<?php

namespace App\Models;

use Database\Factories\FestivalFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['title', 'start_date_time', 'end_date_time', 'genre', 'description', 'location_id'])]
class Festival extends Model
{
    /** @use HasFactory<FestivalFactory> */
    use HasFactory;

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class)->withTimestamps();
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date_time' => 'datetime',
            'end_date_time' => 'datetime',
        ];
    }
}
