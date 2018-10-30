<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Server extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id', 'network', 'type', 'cpu', 'ram', 'disk', 'connection',
    ];

    /**
     * The servers owner.
     */
    public function delegate(): BelongsTo
    {
        return $this->belongsTo(Delegate::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return string
     */
    public function getNetworkNameAttribute(): string
    {
        return [
            'production'  => 'Main Network',
            'development' => 'Development Network',
        ][$this->network];
    }

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('network', function (Builder $builder) {
            $builder
                ->orderBy('network', 'asc')
                ->orderBy('type', 'asc');
        });
    }
}
