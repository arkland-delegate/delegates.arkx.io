<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamMember extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'role', 'body'];

    /**
     * The contribution owner.
     */
    public function delegate(): BelongsTo
    {
        return $this->belongsTo(Delegate::class);
    }
}
