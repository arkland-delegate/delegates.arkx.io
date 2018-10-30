<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

trait OwnsModels
{
    /**
     * Determine whether this model owns the given model.
     *
     * @param Model $model
     *
     * @return bool
     */
    public function owns(Model $model): bool
    {
        return $this->id === (int) $model->{$this->getForeignKey()};
    }
}
