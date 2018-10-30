<?php

namespace App\Models;

use App\Models\Concerns\CanBeCached;
use App\Models\Concerns\CanBeClaimed;
use App\Models\Concerns\CanBeVerified;
use App\Models\Concerns\HasSchemalessAttributes;
use App\Models\Concerns\OwnsModels;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Spatie\Tags\HasTags;

class Delegate extends Model
{
    use HasTags;
    use OwnsModels;
    use HasSchemalessAttributes;
    use CanBeVerified;
    use CanBeCached;
    use CanBeClaimed;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id', 'type', 'username', 'address', 'public_key', 'rank', 'votes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['extra_attributes' => 'array'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['claimed_at', 'verified_at', 'banned_at'];

    /**
     * The delegates owner.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The delegates country.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * The delegates servers.
     */
    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }

    /**
     * The delegates channels.
     */
    public function channels(): HasMany
    {
        return $this->hasMany(Channel::class);
    }

    /**
     * The delegates voters.
     */
    public function voters(): HasMany
    {
        return $this->hasMany(Voter::class);
    }

    /**
     * The delegates statuses.
     */
    public function statuses(): HasMany
    {
        return $this->hasMany(Status::class);
    }

    /**
     * The delegates contributions.
     */
    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }

    /**
     * The delegates subscribers.
     */
    public function subscribers(): HasMany
    {
        return $this->hasMany(Subscriber::class);
    }

    /**
     * The delegates team members.
     */
    public function teamMembers(): HasMany
    {
        return $this->hasMany(TeamMember::class);
    }

    /**
     * The delegates excluded voters.
     */
    public function excludedVoters()
    {
        return $this->voters()->where('is_excluded', true);
    }

    /**
     * The delegates announcements.
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    /**
     * Find a delegate by its username.
     *
     * @param string $username
     *
     * @return \App\Models\Delegate
     */
    public static function findByUsername(string $username): self
    {
        return static::whereUsername($username)->firstOrFail();
    }

    /**
     * Scope a query to only include top 51 delegates.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForging(Builder $query)
    {
        return $query->where('rank', '<=', 51)->orderBy('rank', 'ASC');
    }

    /**
     * Scope a query to only include delegates outside the top 51.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotForging(Builder $query)
    {
        return $query->where('rank', '>', 51)->orderBy('rank', 'ASC');
    }

    /**
     * @return string
     */
    public function getFormattedRankAttribute(): string
    {
        return vsprintf('%02d', $this->rank);
    }

    /**
     * @return string
     */
    public function getFormattedVotesAttribute(): string
    {
        return format_arktoshi($this->votes, 0);
    }

    /**
     * @return array
     */
    public function getLogoAttribute(): string
    {
        $logo = $this->extra_attributes->profile['logo'];

        if (!$logo) {
            $hash = md5($this->username);

            return "https://api.adorable.io/avatars/256/{$hash}.png";
        }

        if (starts_with($logo, 'http')) {
            return str_replace('http://', 'https://', $logo);
        }

        if ($logo) {
            $logo = "storage/{$logo}";
        }

        return asset($logo ?? 'images/default-photo.jpeg');
    }

    /**
     * @return array
     */
    public function getProfileAttribute(): array
    {
        return $this->extra_attributes->profile;
    }

    /**
     * @return array
     */
    public function getSharingAttribute(): array
    {
        return $this->extra_attributes->sharing;
    }

    /**
     * @return array
     */
    public function getVotingAttribute(): array
    {
        return $this->extra_attributes->voting;
    }

    /**
     * @return array
     */
    public function getCalculatorAttribute(): array
    {
        return $this->extra_attributes->calculator;
    }

    /**
     * @return array
     */
    public function getStatisticsAttribute(): array
    {
        return $this->extra_attributes->statistics;
    }

    /**
     * @return int
     */
    public function getVoterCountAttribute(): int
    {
        return $this->voters()->where('is_excluded', false)->count();
    }

    /**
     * @return \Illuminate\Support\Carbon
     */
    public function getLastBlockTimeAttribute(): Carbon
    {
        return Carbon::parse($this->extra_attributes['last_block']);
    }

    /**
     * @return string
     */
    public function getStatusAttribute(): string
    {
        $diff = $this->last_block_time->diffInMinutes();

        if ($diff >= 21) {
            return 'red';
        }

        if ($diff >= 14) {
            return 'orange';
        }

        return 'green';
    }

    /**
     * Get the all statuses and cache them.
     *
     * @return string
     */
    public function getGluedTagsAttribute(): string
    {
        return $this->tags->pluck('name')->implode(',');
    }

    /**
     * Get the all team members and cache them.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCachedTeamMembersAttribute(): Collection
    {
        return Cache::remember($this->cacheKey().':team_members', 10, function () {
            return $this->teamMembers()->latest()->get();
        });
    }

    /**
     * Get the count of all team members and cache it.
     *
     * @return int
     */
    public function getCachedTeamMembersCountAttribute(): int
    {
        return Cache::remember($this->cacheKey().':team_members_count', 10, function () {
            return $this->teamMembers()->count();
        });
    }

    /**
     * Get the all statuses and cache them.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCachedStatusesAttribute(): Collection
    {
        return Cache::remember($this->cacheKey().':statuses', 10, function () {
            return $this->statuses()->latest()->get();
        });
    }

    /**
     * Get the count of all statuses and cache it.
     *
     * @return int
     */
    public function getCachedStatusesCountAttribute(): int
    {
        return Cache::remember($this->cacheKey().':statuses_count', 10, function () {
            return $this->statuses()->count();
        });
    }

    /**
     * Get the all contributions and cache them.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCachedContributionsAttribute(): Collection
    {
        return Cache::remember($this->cacheKey().':contributions', 10, function () {
            return $this->contributions()->latest()->get();
        });
    }

    /**
     * Get the count of all contributions and cache it.
     *
     * @return int
     */
    public function getCachedContributionsCountAttribute(): int
    {
        return Cache::remember($this->cacheKey().':contributions_count', 10, function () {
            return $this->contributions()->count();
        });
    }

    /**
     * Get the all voters and cache them.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCachedVotersAttribute(): Collection
    {
        return Cache::remember($this->cacheKey().':voters', 10, function () {
            return $this->voters()->latest()->get();
        });
    }

    /**
     * Get the count of all voters and cache it.
     *
     * @return int
     */
    public function getCachedVotersCountAttribute(): int
    {
        return Cache::remember($this->cacheKey().':voters_count', 10, function () {
            return $this->voters()->count();
        });
    }

    /**
     * Get the all servers and cache them.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCachedServersAttribute(): Collection
    {
        return Cache::remember($this->cacheKey().':servers', 10, function () {
            return $this->servers()->latest()->get();
        });
    }

    /**
     * Get the count of all servers and cache it.
     *
     * @return int
     */
    public function getCachedServersCountAttribute(): int
    {
        return Cache::remember($this->cacheKey().':servers_count', 10, function () {
            return $this->servers()->count();
        });
    }

    /**
     * Get the all channels and cache them.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCachedChannelsAttribute(): Collection
    {
        return Cache::remember($this->cacheKey().':channels', 10, function () {
            return $this->channels()->latest()->get();
        });
    }

    /**
     * Get the count of all channels and cache it.
     *
     * @return int
     */
    public function getCachedChannelsCountAttribute(): int
    {
        return Cache::remember($this->cacheKey().':channels_count', 10, function () {
            return $this->channels->count();
        });
    }

    /**
     * Get the all subscribers and cache them.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCachedSubscribersAttribute(): Collection
    {
        return Cache::remember($this->cacheKey().':subscribers', 10, function () {
            return $this->subscribers()->latest()->get();
        });
    }

    /**
     * Get the count of all subscribers and cache it.
     *
     * @return int
     */
    public function getCachedSubscribersCountAttribute(): int
    {
        return Cache::remember($this->cacheKey().':subscribers_count', 10, function () {
            return $this->subscribers->count();
        });
    }

    /**
     * Get the stability of the delegate and cache it.
     *
     * @return float
     */
    public function getCachedStabilityAttribute(): float
    {
        return Cache::get("{$this->username}:stability", 0);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'username';
    }

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('rank', function (Builder $builder) {
            $builder->orderBy('rank', 'asc');
        });
    }
}
