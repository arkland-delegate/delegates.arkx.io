<?php

namespace App\Policies;

use App\Models\Delegate;
use App\Models\User;

class DelegatePolicy extends Policy
{
    /**
     * Determine whether the user can update the delegate.
     *
     * @param \App\Models\User     $user
     * @param \App\Models\Delegate $delegate
     *
     * @return mixed
     */
    public function update(User $user, Delegate $delegate)
    {
        return $user->owns($delegate);
    }

    /**
     * Determine whether the user can delete the delegate.
     *
     * @param \App\Models\User     $user
     * @param \App\Models\Delegate $delegate
     *
     * @return mixed
     */
    public function delete(User $user, Delegate $delegate)
    {
        return $user->owns($delegate);
    }
}
