<?php

namespace App\Nova\Actions\Users;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class Impersonate extends Action
{
    use SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection    $models
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if ($models->count() > 1) {
            return Action::danger('You can only impersonate one user at a time.');
        }

        $user = $models->first();

        if ($user->hasRole('admin')) {
            return Action::danger('You cannot impersonate other administrators.');
        }

        return Action::redirect(route('impersonation.start', $user));
    }
}
