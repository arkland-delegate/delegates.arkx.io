<?php

namespace App\Models\Concerns;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait CanBeBanned
{
    public function ban(): bool
    {
        return $this->forceFill(['banned_at' => Carbon::now()])->save();
    }

    public function unban(): bool
    {
        return $this->forceFill(['banned_at' => null])->save();
    }

    public function getIsBannedAttribute(): bool
    {
        return !empty($this->banned_at);
    }

    public function scopeBanned(Builder $query): Builder
    {
        return $query->whereNotNull('banned_at');
    }

    public function scopeNotBanned(Builder $query): Builder
    {
        return $query->whereNull('banned_at');
    }
}
