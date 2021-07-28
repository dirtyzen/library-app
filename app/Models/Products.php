<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return array
     */
    public function getTracksAttribute(): array
    {
        return empty($this->track_list) ? [] : explode("\n", $this->track_list);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIdDescOrder(Builder $query): Builder
    {
        return $query->orderBy('id', 'DESC');
    }

    /**
     * @param Builder $query
     * @param string $categorySlug
     * @param string $productSlug
     * @param int $productId
     * @return Builder
     */
    public function scopeShow(Builder $query, string $categorySlug, string $productSlug, int $productId): Builder
    {
        return $query->where('id', '=', $productId)
            ->where('slug', '=', $productSlug)
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', '=', $categorySlug);
            });
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }
}
