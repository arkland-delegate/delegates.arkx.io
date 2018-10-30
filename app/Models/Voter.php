<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['address', 'balance', 'is_excluded'];

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['delegate'];

    public function delegate(): BelongsTo
    {
        return $this->belongsTo(Delegate::class);
    }

    public function getFormattedBalanceAttribute(): string
    {
        return format_arktoshi($this->balance, 0);
    }

    public static function findByAddress(string $address): self
    {
        return static::whereAddress($address)->firstOrFail();
    }

    public function markAsIncluded(): void
    {
        $this->update(['is_excluded' => false]);
    }

    public function markAsExcluded(): void
    {
        $this->update(['is_excluded' => true]);
    }
}
