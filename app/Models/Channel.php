<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Channel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'handle', 'location'];

    /**
     * The servers owner.
     */
    public function delegate(): BelongsTo
    {
        return $this->belongsTo(Delegate::class);
    }
}
