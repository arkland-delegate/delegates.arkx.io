<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Status extends Model
{
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body'];

    /**
     * The servers owner.
     */
    public function delegate(): BelongsTo
    {
        return $this->belongsTo(Delegate::class);
    }

    /**
     * @return string
     */
    public function getDayAttribute(): string
    {
        return $this->created_at->format('d');
    }

    /**
     * @return string
     */
    public function getMonthAttribute(): string
    {
        return $this->created_at->format('M');
    }

    /**
     * @return string
     */
    public function getIsRecentAttribute(): bool
    {
        return $this->created_at->diffInDays() <= 7;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }
}
