<?php

namespace App\Models;

use App\Models\Concerns\CanBeBanned;
use App\Models\Concerns\OwnsModels;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;
    use CanBeBanned, HasRoles, OwnsModels;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'api_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['banned_at'];

    public function delegates(): HasMany
    {
        return $this->hasMany(Delegate::class);
    }

    /**
     * Get a user by the given e-mail address.
     *
     * @return \App\Models\User
     */
    public static function findByEmail(string $value): self
    {
        return static::whereEmail($value)->firstOrFail();
    }
}
