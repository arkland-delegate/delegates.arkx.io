<?php

namespace App\Models\Concerns;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait CanBeVerified
{
    public function verify(): bool
    {
        return $this->forceFill(['verified_at' => Carbon::now()])->save();
    }

    public function unverify(): bool
    {
        return $this->forceFill(['verified_at' => null])->save();
    }

    public function getIsVerifiedAttribute(): bool
    {
        return !empty($this->verified_at);
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->whereNotNull('verified_at');
    }

    public function scopeUnverified(Builder $query): Builder
    {
        return $query->whereNull('verified_at');
    }
}
