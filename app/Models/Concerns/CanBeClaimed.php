<?php

namespace App\Models\Concerns;

use App\Notifications\DelegateVerified;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait CanBeClaimed
{
    /**
     * Scope a query to only include claimed wallets.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClaimed(Builder $query): Builder
    {
        return $query
            ->whereNotNull('claimed_at')
            ->whereNotNull('verified_at');
    }

    /**
     * Scope a query to only include unclaimed wallets.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnclaimed(Builder $query): Builder
    {
        return $query
            ->whereNull('claimed_at')
            ->whereNull('verified_at');
    }

    /**
     * Scope a query to only include lost pending.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending(Builder $query): Builder
    {
        return $query
            ->whereNotNull('claimed_at')
            ->whereNull('verified_at');
    }

    /**
     * Scope a query to only include lost wallets.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLost(Builder $query): Builder
    {
        return $query
            ->orderBy('rank', 'asc')
            ->where('user_id', 1)
            ->whereNull('verified_at');
    }

    /**
     * Activate the wallet.
     */
    public function activate(): void
    {
        $this->forceFill([
            'verification_token' => null,
            'verified_at'        => Carbon::now(),
        ])->save();

        $this->user->notify(new DelegateVerified($this));
    }

    /**
     * Reset the wallet.
     */
    public function reset(): void
    {
        $this->forceFill([
            'user_id'            => 1,
            'claimed_at'         => null,
            'verification_token' => null,
        ])->save();
    }

    /**
     * Check if the claim session has expired.
     *
     * @return bool
     */
    public function claimHasExpired(): bool
    {
        if (!$this->claimed_at && !$this->verified_at) {
            return true;
        }

        if ($this->verified_at) {
            return true;
        }

        return $this->claimed_at && $this->claimed_at->diffInMinutes() >= 5;
    }
}
